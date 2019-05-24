$(document).ready(function(){
var acc = document.querySelectorAll(".knowledge__accordion");
var prMenu = document.getElementById("prMenu");
var parObj = document.querySelector('.info-header');  


$(document).on('click','#workList', function(e){
let target = e.target;

if($(target).hasClass("progress"))
{
	target.classList.toggle("active");
	var panel = target.nextElementSibling;
	console.log(panel);	
     if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
	  panel.style.minHeight = '100px';
    }
}
});

$(".workStatus").on("click", function(){
		$.ajax({
		type: "POST",
		url: "./include/work_list.php",
		dataType: "html",
		cache: false,
		success: function(html) {
		$("#goodJob").html(html);
		}
	});
});


$(document).on('click','.main-left__article', function(e){  
	let hrefNum = $(this).attr('href');
	alert(hrefNum);
	
	$.ajax({
		type: "POST",
		url: "./include/view_news.php",
		dataType: "json",
		cache: false,
		data: {hrefNum:hrefNum},
		success: function(result) {
		console.log(result);
		var resNews = result;
		$("#appPopup").fadeIn("slow");
		var titleNews = document.getElementById("newsTitle");
		var descriptionNews = document.querySelector(".main-left__container");
		console.log(descriptionNews);
		titleNews.textContent = resNews[0].title;
		descriptionNews.textContent = resNews[0].description;
		}
		});
});


$(document).on('click','#addPerformer', function(){  
	$("#viewPerform").fadeIn("slow");
	$.ajax({
		type: "POST",
		url: "./include/view_perform.php",
		dataType: "html",
		cache: false,
		success: function(data) {
			$("#perfTable").html(data);
			
			$.ajax({
				type: "POST",
				url: "./include/view_perform.php",
				dataType: "json",
				cache: false,
				success: function(result) {
				console.log(result);
				var qtyTasks = result;
				}
			});
		}
	});
	
});

$(document).on('click','#PerformClose', function(){
	$("#viewPerform").fadeOut("slow");
});

$(document).on('click','.editApp', function(e){  
	let num = $(this).attr('href');
	console.log(num);
	
		
	$.ajax({
		type: "POST",
		url: "./include/view_app.php",
		dataType: "json",
		cache: false,
		data: {num:num},
		success: function(result) {
		var res = result;
		console.log(res);
		$("#appPopup").fadeIn("slow");
		$("#num_app").html("Заявка №: " + res[0].id_application);
		$("#title_app").val(res[0].title);
		$("#description_app").val(res[0].description);
		$("#date").val(res[0].start_date); 
		$("#lastDate").val(res[0].deadline); 
		$("#comment_app").val(res[0].comment);
		
		if(res[0].performers != null)
			{
				newObj.innerHTML = '';
				let name = (res[0].performers);
				newObj.textContent = res[0].performers;
			}else {
				newObj.innerHTML = '';
				newObj.textContent = "Назначить";
			}
		}
		});
});

$(document).on('click','#hPerform', function(e){  
	let num = $(this).attr('href');
	alert(num);
	
	$.ajax({
		type: "POST",
		url: "./include/add_perform.php",
		dataType: "json",
		cache: false,
		data: {num:num},
		success: function(result) {
		console.log(result);
		var resPerf = result;
		newObj.textContent = resPerf[0].first_name;
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
			$.ajax({
		type: "POST",
		url: "./include/inbox_app.php",
		dataType: "html",
		cache: false,
		success: function(html) {
		$("#inboxApp").html(html);
		}
	});
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


$(".appWork").on("click", function(){
		$.ajax({
		type: "POST",
		url: "./include/work_app.php",
		dataType: "html",
		cache: false,
		success: function(html) {
		$("#inWork").html(html);
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
				$("#inboxApp").html(html);
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