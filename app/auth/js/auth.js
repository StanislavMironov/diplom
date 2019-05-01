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
