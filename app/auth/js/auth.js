function callauth() {
var msg   = $('#formAuth').serialize();
$.ajax({
  type: 'POST',
  url: '../include/auth.php',
  data: msg,
  success: function(data) {
  $('#results').html(data);
  console.log(data);
  if(data == 'yes_auth')
  {
	var url = "../index.php";
	$(location).attr('href',url);
  }
  else
  {
  $("#message-auth").slideDown(400);
  }
  },
  error:  function(xhr, str){
alert('Возникла ошибка: ' + xhr.responseCode);
  }
});
}

/* $("#remind").on("click", function(){
	let recall_email = $("#remind-email").val();
	
	if(recall_email == "" || recall_email > 20)
	{
		$("#remind-email").css("borderColor","#FDB6B6");
	} else
	{
		$("#remind-email").css("borderColor","#DBDBDB");
		
		$.ajax({
			type: "POST",
			url: "../include/remind-pass.php",
			data: "email=" + recall_email,
			dataType: "html",
			cache: false,
			success: function(data) {
			console.log(data);
			 if(data == "yes"){
			 $("#message-remind").fadeIn();
			 setTimeout(function() { $("#message-remind").slideUp(); }, 3500);
				$("#message-remind").attr("class","message-remind-success").html("На ваш e-mail выслан пароль.").slideDown(400);
			 }
			 else{
				$("#message-remind").attr("class","message-remind-error").html(data).slideDown(400);
				setTimeout(function() { $("#message-remind").slideUp(); }, 3500);
			 }
			}
		});
	}
	
});  */