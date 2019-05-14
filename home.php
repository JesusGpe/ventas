<?php 
    session_start();
    if(!isset($_SESSION["id"])){
        header("Location: index.php");
    }
 ?>

<!DOCTYPE html>
<html lang="es">

<?php include('head.php') ?>

<link href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php include('sidebar.php') ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <?php include('navbar.php') ?>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">Inicio</h3>
            </div>
            <div class="card-body">
                <div class="row">
                      <h3>Aqui va ha ser lo principal</h3> 
                </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <?php include('footer.php') ?>
  <script>
        $(document).ready(function(){
            
            listar();
        });

      function agregar(idcliente,producto,id,precio){
        var cantidad = $("#cantidad_"+id).val();
        alert(idcliente + producto + cantidad + precio);
        var subtotal = precio * cantidad;
        var datos ={idcliente:idcliente,producto:producto,cantidad:cantidad,precio:precio,subtotal:subtotal,opc:'agregar'};
        $.ajax({
            cache: false,
            url: 'ajax/carrito.php',
            type: 'POST',
            dataType: 'JSON',
            data: datos,
            success: function(response) {
                if(!response.error){
                    console.log(response.mensaje);
                    listar();
                }
            },
            error: function(xhr, status, error) {
              console.log(xhr.responseText);
            }
        });
        
        
      }

      function listar(){
        var datos = {opc:'listar'};
        $.ajax({
            cache: false,
            url: 'ajax/carrito.php',
            type: 'POST',
            dataType: 'JSON',
            data: datos,
            success: function(response) {
                console.log(response);
                $("#table-car").html(response.html);
            },
            error: function(xhr, status, error) {
              console.log(xhr.responseText);
            }
        });
      }

      
  </script>
  </body>
</html>
