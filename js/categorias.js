var edit = false;

$(document).ready(function(){
	$("#table").DataTable();
	console.log("Documento listo");
	$('#registerModal').on('show.bs.modal', function (event) {
		if (edit) {
			console.log("edit");
			$("#btnRegistrar").html("Editar");
			var button = $(event.relatedTarget);
		  	var id = button.data('id');
		  	var nombre = button.data('nombre');
		  	var descripcion = button.data('descripcion');
		  	var modal = $(this);
		  	modal.find('#id').val(id);
		  	modal.find('#nombre').val(nombre);
		  	modal.find('#descripcion').val(descripcion);
		}
	});

	$('#registerModal').on('hide.bs.modal', function (event) {
		$("#btnRegistrar").html("Registrar");
		var modal = $(this);
		modal.find('#id').val('');
		modal.find('#nombre').val('');
		modal.find('#precio').val('');
		edit = false;
	});

	$( ".btnEditar" ).click(function() 
	{
		edit = true;
	});
});

$("#frm-registrar").submit(function( event ) {
	event.preventDefault();
	var opc = "registrar";
	if(edit){
		opc = "editar"
	}

	var id = $("#id").val();
	var nombre = $("#nombre").val();
	var descripcion = $("#descripcion").val();
	var objParam = {
				'opc':opc,
				'id' : id,
				'nombre': nombre,
				'descripcion': descripcion
				};

	$.ajax({
	    cache: false,
	    url: 'php/RouterCategoria.php',
	    type: 'POST',
	    dataType: 'JSON',
	    data: objParam,
	    success: function(response) {
	    	if(!response.error){
	    		$("#mensaje").html('<div class="alert alert-success text-center" role="alert">¡'+response.mensaje+'!</div>');
	    		setTimeout(function(){
	    			location.href="categorias.php";
	    		},2000);
	    	}
	    },
	    error: function(xhr, status, error) {
	      console.log(xhr.responseText);
	    }
	});
});

function eliminar(id){
	console.log(id);

	alertify.confirm("Confirmacion","¿Desea eliminar la categoria?",
	  function() {
	  	$.ajax({
		    cache: false,
		    url: 'php/RouterCategoria.php',
		    type: 'POST',
		    dataType: 'JSON',
		    data: {id:id,opc:'eliminar'},
		    success: function(response) {
		    	if(!response.error){
		    		console.log(response);
		    		$("#mensaje").html('<div class="alert alert-success text-center" role="alert">¡'+response.mensaje+'!</div>');
		    		setTimeout(function(){
		    			location.href="categorias.php";
		    		},2000);
		    	}
		    },
		    error: function(xhr, status, error) {
		      console.log(xhr.responseText);
		    }
		});

	    
	  },
	  function() {
	    
	  }
	);
}