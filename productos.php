<?php 
    
    include 'ajax/conexion.php';
    $conexion = conectar();
    $sql = "select p.id,p.nombre,p.descripcion,p.precio,p.precio_compra,p.stock,c.nombre as categoria from productos p inner join categorias c on p.idcategoria = c.id";
    $result = mysqli_query($conexion,$sql);
    $sql2 = "select * from categorias";
    $result2 = mysqli_query($conexion,$sql2);
 ?>

<!DOCTYPE html>
<html lang="en">

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
              <h3 class="m-0 font-weight-bold text-primary">Productos</h3>
              <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#registerModal">Nuevo</button>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Descripcion</th>
                      <th>Precio</th>
                      <th>Precio compra</th>
                      <th>Stock</th>
                      <th>Categoria</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($row = mysqli_fetch_array($result)) {
                     ?>
                    <tr>
                      <td><?php echo $row["nombre"] ?></td>
                      <td><?php echo $row["descripcion"] ?></td>
                      <td><?php echo $row["precio"] ?></td>
                      <td><?php echo $row["precio_compra"] ?></td>
                      <td><?php echo $row["stock"] ?></td>
                      <td><?php echo $row["categoria"] ?></td>
                      <td>
                        <button type="button" class="btn btn-sm btn-warning" id="btnEditar" data-id="<?php echo $row["id"] ?>" data-nombre="<?php echo $row["nombre"] ?>" data-descripcion="<?php echo $row["descripcion"] ?>" data-precio="<?php echo $row["precio"] ?>" data-precio_compra="<?php echo $row["precio_compra"] ?>" data-stock="<?php echo $row["stock"] ?>" data-imagen="<?php echo $row["imagen"] ?>" data-categoria="<?php echo $row["idcategoria"] ?>" onclick="edit=true;" data-toggle="modal" data-target="#registerModal"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="<?php echo "eliminar(".$row["id"].")" ?>"><i class="fa fa-trash"></i></button>
                      </td>
                    </tr>
                    <?php } ?>
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
              <input type="text" name="descripcion" class="form-control" id="descripcion">
            </div>
            <div class="form-group">
              <label>Precio</label>
              <input type="text" name="precio" class="form-control" id="precio">
            </div>
            <div class="form-group">
              <label>Precio compra</label>
              <input type="text" name="precio_compra" class="form-control" id="precio_compra">
            </div>
            <div class="form-group">
              <label>Stock</label>
              <input type="text" name="stock" class="form-control" id="stock">
            </div>
            <div class="form-group">
              <label>Categoria</label>
              <select name="idcategoria" class="form-control">
                  <?php while ($row=mysqli_fetch_array($result2)) {
                    ?>
                    <option value="<?php echo $row["id"] ?>"><?php echo $row["nombre"]; ?></option>
                <?php } ?>
              </select>
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
  <script src="js/productos.js"></script>
</body>

</html>
