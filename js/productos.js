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
		  	var precio = button.data('precio');
		  	var precio_compra = button.data('precio_compra');
		  	var stock = button.data('stock');
		  	var imagen = button.data('imagen');
		  	var modal = $(this);
		  	modal.find('#id').val(id);
		  	modal.find('#nombre').val(nombre);
		  	modal.find('#descripcion').val(descripcion);
		  	modal.find('#precio').val(precio);
		  	modal.find('#precio_compra').val(precio_compra);
		  	modal.find('#stock').val(stock);
		  	$('#imagenmuestra').attr('src', 'img/productos/' + imagen);
		}
	});

	$('#registerModal').on('hide.bs.modal', function (event) {
		$("#btnRegistrar").html("Registrar");
		var modal = $(this);
		modal.find('#id').val('');
		modal.find('#nombre').val('');
		modal.find('#descripcion').val('');
		edit = false;
	});


});

$("#frm-registrar").submit(function( event ) {
	event.preventDefault();
	var opc = "registrar";
	if(edit){
		opc = "editar"
	}
	var formData = new FormData(this);
	formData.append("opc",opc);
	$.ajax({
	    cache: false,
	    url: 'ajax/productos.php',
	    type: 'POST',
	    dataType: 'JSON',
	    data: formData,
	    processData: false,
    	contentType: false,
	    success: function(response) {
            console.log(response);
	    	if(!response.error){
	    		$("#mensaje").html('<div class="alert alert-success text-center" role="alert">¡'+response.mensaje+'!</div>');
	    		setTimeout(function(){
	    			location.href="productos.php";
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
		    url: 'ajax/productos.php',
		    type: 'POST',
		    dataType: 'JSON',
		    data: {id:id,opc:'eliminar'},
		    success: function(response) {
		    	if(!response.error){
		    		console.log(response);

		    		setTimeout(function(){
		    			location.href="productos.php";
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

$("#imagen").change(function() {
  readURL(this);
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      // Asignamos el atributo src a la tag de imagen
      $('#imagenmuestra').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}