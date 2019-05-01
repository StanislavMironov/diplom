$(document).ready(function(){

var recall_email = $("#remind-email").val();

if (recall_email == "" || recall_email.length > 20) 
{
	$("#remind-email").css("borderColor","#FDB6B6");	
}else
{
	$("#remind-email").css("borderColor","#DBDBDB");
	
	$.ajax({
		type: "POST",
		url: "../include/remind-pass.php",
		data: "email="+recall_email,
		dataType: "html",
		cache: false,
		success: function(data){
		if (data == 'yes') 
		{
			$('#message-remind').attr("class","message-remind-success").html("На ваш e-mail выслан пароль.").slideDown(400);
			setTimeout("$('#message-remind').html('').hide(),$('#block-remind').hide()", 3000);
		}else
		{
			$("#message-remind").attr("class","message-remind-error").html(data).slideDown(400);
		}
		}
	});
}


$("#rise-pass").click(function(){
	$("#block-remind").fadeIn(400, function(){});
	$("#popup").addClass("overlay_popup");
	$(".limiter").addClass("bBg");
	
});

$("#popap-close").click(function(){
	$("#block-remind").fadeOut(400);
	$("#popup").removeClass("overlay_popup");
	$(".limiter").removeClass("bBg");
});

$("#popap-close").mouseenter(function() {
     $(this).addClass('rotate360');
	 $(this).removeClass('rotate_360');
});

$("#popap-close").mouseout(function() {
     $(this).removeClass('rotate360');
	 $(this).addClass('rotate_360');
});
});	
	$(document).ready(function(){
    $(document).on("overlay:showing", function() {
        $("#top").css("filter", "blur(5px)");
		console.log(5);
    });
    $(document).on("overlay:hidden", function() {
        $("#top").css("filter", "blur(0px)");
		console.log(6);
    });
});
