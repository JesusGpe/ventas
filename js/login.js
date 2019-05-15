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

        $.ajax({
            cache: false,
            url: 'php/RouterLogin.php',
            type: 'POST',
            dataType: 'JSON',
            data: objParam,
            success: function(response) {
                if(response.respuesta == 1){
                	var infoRespuestaWS = response.infoResponse;
                	var usuario = infoRespuestaWS.respuesta
                    $("#mensaje").html('<div class="alert alert-success text-center" role="alert">¡ Bienvenido ' + usuario.nombre + '!</div>');
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