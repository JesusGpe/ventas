$(document).ready(function(){
	$("#frm-login").submit(function( event ) 
	{
        event.preventDefault();
        var email = $("#email").val();
		var password = $("#password").val();
		
		var objParam = {
				'opc':'login',
				'email' : email,
				'password' : password				
				};
		console.log(objParam);

        $.ajax({
            cache: false,
            url: 'php/RouterLogin.php',
            type: 'POST',
            dataType: 'JSON',
            data: objParam,
            success: function(response) {
                console.log(response);
                if(response.respuesta == 1){
                    $("#mensaje").html('<div class="alert alert-success text-center" role="alert">¡ '+response.mensaje+'!</div>');
                    setTimeout(function(){
                        location.href="home.php";
                    },2000);
                }else{
                    $("#mensaje").html('<div class="alert alert-danger text-center" role="alert">¡'+response.mensaje+'!</div>');
                }
            },
            error: function(xhr, status, error) {
              console.log(xhr.responseText);
            }
        });
    });
});