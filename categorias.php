<?php 
    
    include 'ajax/conexion.php';
    $conexion = conectar();
    $sql = "select * from categorias";
    $result = mysqli_query($conexion,$sql);
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
              <h3 class="m-0 font-weight-bold text-primary">Categorias</h3>
              <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#registerModal"><i class="fa fa-plus"></i> Nuevo</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table">
                        <thead>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Opciones</th>
                        </thead>
                        <tbody>
                            <?php 
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                            <tr>
                                <td><?php echo $row["nombre"] ?></td>
                                <td><?php echo $row["descripcion"] ?></td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#registerModal" onclick="edit = true" data-id = "<?php echo $row['id'] ?>"
                                        data-nombre="<?php echo $row['nombre'] ?>" data-descripcion="<?php echo $row['descripcion'] ?>"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger" onclick="eliminar(<?php echo $row['id']; ?>)"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php
                             } ?>
                        </tbody>
                    </table>
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
            <span>Copyright &copy; IGAPP 2019</span>
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

  <!-- Logout Modal-->
  <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Registrar categoria</h3>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" id="frm-registrar">
            <div class="form-group">
              <label>Nombre</label>
                <input type="hidden" name="id" class="form-control" id="id">
              <input type="text" name="nombre" class="form-control" id="nombre" required>
            </div>
            <div class="form-group">
              <label>Descripcion</label>
              <input type="text" name="descripcion" class="form-control" id="precio">
            </div>
            <div id="mensaje"></div>
            <div class="modal-footer">
              <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
              <button class="btn btn-primary" type="submit" id="btnRegistrar">Registrar</button>
            </div>
          </form>
        </div>    
      </div>
    </div>
  </div>
  <?php include('footer.php') ?>
  <script src="js/categorias.js"></script>
</body>

</html>
