$(document).ready(function(){
let acc = document.querySelectorAll(".knowledge__accordion");
let prBtn = document.getElementById("tool");
let prMenu = document.getElementById("prMenu");
let parObj = document.querySelector('.info-header');  



$(document).on('click','#addPerformer', function(){  
	$("#viewPerform").fadeIn("slow");
});


$(document).on('click','#PerformClose', function(){
	$("#viewPerform").fadeOut("slow");
});

$(document).on('click','.editApp', function(e){  
	let num = $(this).attr('href');
	$.ajax({
		type: "POST",
		url: "./include/view_app.php",
		dataType: "json",
		cache: false,
		data: {num:num},
		success: function(result) {
		console.log(result);
		var res = result;
		$("#appPopup").fadeIn("slow");
		$("#num_app").html("Заявка №: " + res[0].id_application);
		$("#title_app").val(res[0].title);
		$("#description_app").val(res[0].description);
		$("#date").val(res[0].start_date); 
		$("#lastDate").val(res[0].deadline); 
		$("#comment_app").val(res[0].comment);
		}
		});
});

$(document).on('click','.knowledge__link', function(e){
	$("#appPopup").fadeIn("slow");
	let target = e.target;
	let num = $(this).attr('href');

	$.ajax({
	type: 'POST',
	url: './include/view_knowledge.php',
	dataType: "json",
	cache: false,
	data: {num:num},
	success: function(result) {
	var res = result;
	$(".knowTitle").html(res[0].title);
	$(".knowDescription").html(res[0].description);
	}
	});
});


$(document).on('click','#popup-close', function(e){
	$("#appPopup").fadeOut("slow");
});

$(document).on('click','#save_app', function(e){
 var app = $('#formEditApp').serialize();
 $.ajax({
	type: 'POST',
	url: './include/edit_app.php',
	data: app,
	success: function(data) {
	
	if(data == "ok")
	{
		$('.changeStatus').addClass('form-success').removeClass('form-error');
		$('.changeStatus').html("Изменения успешно сохранены!");
		$('.changeStatus').slideDown();
		setTimeout(function() { $(".changeStatus").slideUp(); }, 2000);
	}
	else
	{
		$('.changeStatus').addClass('form-error').removeClass('form-success');
		$('.changeStatus').html(data);
		$('.changeStatus').slideDown();
		setTimeout(function() { $(".changeStatus").slideUp(); }, 3500);
	}
	}
	});
});



$(".appInbox").on("click", function(){
		$.ajax({
		type: "POST",
		url: "./include/inbox_app.php",
		dataType: "html",
		cache: false,
		success: function(html) {
		$("#inboxApp").html(html);
		}
	});
});

$(".appCreate").on("click", function(){
		$.ajax({
		type: "POST",
		url: "./include/update_app.php",
		dataType: "html",
		cache: false,
		success: function(html) {
		$("#myApp").html(html);
		}
	});
});

$(document).on('click','.delApp', function(e){
e.preventDefault();
let aHref = $(this).attr('href');
alert(aHref);
	$.ajax({
		type: "POST",
		url: "./include/delete_app.php",
		data: {aD:aHref},
		dataType: "html",
		cache: false,
		success: function(data) {
		alert(data);
			if(data == 'ok')
			{
			var target, elParent, elGr;
			target = e.target;
			elParent = target.parentNode.parentNode.parentNode;
			elGr = elParent;
			elParent.style="display:none";
			
			$.ajax({
				type: "POST",
				url: "./include/update_app.php",
				dataType: "html",
				cache: false,
				success: function(html) {
				$("#myApp").html(html);
			}
			});
			}
		}
	});
});

$("#clear_submit").on("click", function(){
	$("#description").val("");
	$("#full-description").val("");
	$("#file").val("");
	$("#sFile").val("");
});


$('#create_submit').click(function(){
	var fd = new FormData(document.getElementById("createApp"));
	fd.append("CustomField", "This is some extra data");
	$.ajax({
	  url: "./include/create_app.php",
	  type: "POST",
	  data: fd,
	  processData: false,  
	  contentType: false, 
	  success: function(data)
	  {
		  if(data == 'create')
			{
				$("#form_error").attr('id', 'form-success');
				$("#form-success").html("Заявка успешно создана!");
				$("#form-success").slideDown(400);
				setTimeout(function() { $("#form-success").slideUp(); }, 4000);
			}else
			{
				$("#form-success").attr('id', 'form_error')
				$("#form_error").html(data);
				$("#form_error").slideDown(400);
				setTimeout(function() { $("#form_error").slideUp(); }, 4000);
			}	
	  }
		});
});

$('.info-header__tab').click(function(){
if(!$(this).hasClass('active')){
	$(this).siblings().removeClass('active');
	$(this).addClass('active');
}
});

$(".custom-select").each(function() {
  var classes = $(this).attr("class"),
      id      = $(this).attr("id"),
      name    = $(this).attr("name");
  var template =  '<div class="' + classes + '">';
      template += '<span class="custom-select-trigger">' + $(this).attr("placeholder") + '</span>';
      template += '<div class="custom-options">';
      $(this).find("option").each(function() {
        template += '<span class="custom-option ' + $(this).attr("class") + '" data-value="' + $(this).attr("value") + '">' + $(this).html() + '</span>';
      });
  template += '</div></div>';
  
  $(this).wrap('<div class="custom-select-wrapper"></div>');
  $(this).hide();
  $(this).after(template);
});

$(".custom-option:first-of-type").hover(function() {
  $(this).parents(".custom-options").addClass("option-hover");
}, function() {
  $(this).parents(".custom-options").removeClass("option-hover");
});
$(".custom-select-trigger").on("click", function() {
  $('html').one('click',function() {
    $(".custom-select").removeClass("opened");
  });
  $(this).parents(".custom-select").toggleClass("opened");
  event.stopPropagation();
});

$(".custom-option").on("click", function() {
  $(this).parents(".custom-select-wrapper").find("select").val($(this).data("value"));
  $(this).parents(".custom-options").find(".custom-option").removeClass("selection");
  $(this).addClass("selection");
  $(this).parents(".custom-select").removeClass("opened");
  $(this).parents(".custom-select").find(".custom-select-trigger").text($(this).text());
});

$('#logout').click(function(){
	$.ajax({
		type: "POST",
		url: "./include/logout.php",
		dataType: "html",
		cache: false,
		success: function(data) {
			if(data == 'logout')
			{
				var url = "auth/login.php";
				$(location).attr('href',url);
			}
		}
	});
}); 


prBtn.addEventListener('click', ()=>{
prMenu.classList.toggle('active');
});

   $('#form_reg').validate(
                {   
                    // правила для проверки
                    rules:{
                        "reg_login":{
                            required:true,
                            minlength:5,
                            maxlength:15,
                            remote: {
                            type: "post",    
                            url: "./reg/check_login.php"
                            }
                        },
                        "reg_pass":{
                            required:true,
                            minlength:7,
                            maxlength:15
                        },
                        "reg_surname":{
                            required:true,
                            minlength:3,
                            maxlength:15
                        },
                        "reg_name":{
                            required:true,
                            minlength:3,
                            maxlength:15
                        },
                        "reg_patronymic":{
                            required:true,
                            minlength:3,
                            maxlength:25
                        },
                        "reg_email":{
                            required:true,
                            email:true
                        },
                        "reg_phone":{
                            required:true
                        },
                        "reg_address":{
                            required:true
                        },
                        "reg_captcha":{
                            required:true,
                            remote: {
                            type: "post",    
                            url: "/reg/check_captcha.php"
                            },
                            
                            
                        }
                    },
 
                    // выводимые сообщения при нарушении соответствующих правил
                    messages:{
                        "reg_login":{
                            required:"Укажите Логин!",
                            minlength:"От 5 до 15 символов!",
                            maxlength:"От 5 до 15 символов!",
                            remote: "Логин занят!"
                        },
                        "reg_pass":{
                            required:"Укажите Пароль!",
                            minlength:"От 7 до 15 символов!",
                            maxlength:"От 7 до 15 символов!"
                        },
                        "reg_surname":{
                            required:"Укажите вашу Фамилию!",
                            minlength:"От 3 до 20 символов!",
                            maxlength:"От 3 до 20 символов!"                            
                        },
                        "reg_name":{
                            required:"Укажите ваше Имя!",
                            minlength:"От 3 до 15 символов!",
                            maxlength:"От 3 до 15 символов!"                               
                        },
                        "reg_patronymic":{
                            required:"Укажите ваше Отчество!",
                            minlength:"От 3 до 25 символов!",
                            maxlength:"От 3 до 25 символов!"  
                        },
                        "reg_email":{
                            required:"Укажите свой E-mail",
                            email:"Не корректный E-mail"
                        },
                        "reg_phone":{
                            required:"Укажите номер телефона!"
                        },
                        "reg_address":{
                            required:"Необходимо указать адрес доставки!"
                        },
                        "reg_captcha":{
                            required:"Введите код с картинки!",
                            remote: "Не верный код проверки!"
                            
                        }
                    },
                    
                        submitHandler: function(form){
                        $(form).ajaxSubmit({
                        success: function(data) {                  
                            if (data){
							
                                $("#block-form-registration").fadeOut(300,function() {   
                                    $("#reg_message").addClass("reg_message_good").fadeIn(400).html("Вы успешно зарегистрированы! "+data);
                                    $("#form_submit").hide();
                                });
								return true;
                            }else{
                                  $("#block-form-registration").fadeOut(300,function() {   
                                    $("#reg_message").addClass("reg_message_good").fadeIn(400).html("Вы успешно зарегистрированы! "+data);
                                    $("#form_submit").hide();
                                });
                            }
                        } 
                }); 
            }
            });
        
for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
  
  this.classList.toggle("active");
    var panel = this.nextElementSibling;
     if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
	
	let idBlock = $(this).attr('id');
	var Content = this;
	
  $.ajax({
	type: "POST",
	url: "./include/view_question.php",
	dataType: "html",
	cache: false,
	data: {idBlock:idBlock},
		success: function(html) {
			let cBlock = Content.nextElementSibling;
			jQuery(cBlock).html(html);
		}
	});
	
	let panelHref = this.nextElementSibling;
	
	let num = $(panelHref).on("click", function(e){
	var target = e.target.parentNode;
	});   
  });
}

$(".slct").click(function(){
/* Заносим выпадающий список в переменную */
var dropBlock = $(this).parent().find('.drop');
	
/* Делаем проверку: Если выпадающий блок скрыт то делаем его видимым*/
if( dropBlock.is(':hidden') ) {
	dropBlock.slideDown();

	/* Выделяем ссылку открывающую select */
	$(this).addClass('active');

	/* Работаем с событием клика по элементам выпадающего списка */
	$('.drop').find('li').click(function(){

		/* Заносим в переменную HTML код элемента
		списка по которому кликнули */
		var selectResult = $(this).html();
		
		
		/* Находим наш скрытый инпут и передаем в него
		значение из переменной selectResult */
		$(this).parent().parent().find('input').val(selectResult);
		/* Передаем значение переменной selectResult в ссылку которая
		открывает наш выпадающий список и удаляем активность */
		$(this).parent().parent().find('.slct').removeClass('active').html(selectResult);

		/* Скрываем выпадающий блок */
		dropBlock.slideUp();
	});

	/* Продолжаем проверку: Если выпадающий блок не скрыт то скрываем его */
	} else {
		$(this).removeClass('active');
		dropBlock.slideUp();
	}

	/* Предотвращаем обычное поведение ссылки при клике */
	return false;
});

// = Load
// отслеживаем изменение инпута file
$('#file').change(function(){
	// Если файл прикрепили то заносим значение value в переменную
	var fileResult = $(this).val();
	// И дальше передаем значение в инпут который под загрузчиком
	$(this).parent().find('.fileLoad').find('input').val(fileResult);
});

/* Добавляем новый класс кнопке если инпут файл получил фокус */
$('#file').hover(function(){
	$(this).parent().find('button').addClass('button-hover');
}, function(){
	$(this).parent().find('button').removeClass('button-hover');
});

let tab = document.querySelectorAll('.info-header__tab'),
info = document.querySelector('.info-header'),
tabContent = document.querySelectorAll('.application__tabcontent');
       
function hideTabContent(a) {
	for (let i = a; i < tabContent.length; i++) {
		tabContent[i].classList.remove('show');
		tabContent[i].classList.add('hide');
	}
}

hideTabContent(1);

function showTabContent(b) {
	if (tabContent[b].classList.contains('hide')) {
		tabContent[b].classList.remove('hide');
		tabContent[b].classList.add('show');
	}
}

info.addEventListener('click', function(event) {
	let target = event.target;
	if (target && target.classList.contains('info-header__tab')) {
	for(let i = 0; i < tab.length; i++) {
			if (target == tab[i]) {
				hideTabContent(0);
				showTabContent(i);
				break;
			}
		}
	}
});
});	