<?php
  $page_title = 'Lista de proveedores';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
  $all_proveedores = find_all('proveedor')
?>
<?php
 if(isset($_POST['add_pro'])){
   $req_field = array('proveedor-name','Telefono','Direccion');
   validate_fields($req_field);
   $pro_name = remove_junk($db->escape($_POST['proveedor-name']));
   $pro_tel = remove_junk($db->escape($_POST['Telefono']));
   $pro_direc = remove_junk($db->escape($_POST['Direccion']));
   if(empty($errors)){
      $sql  = "INSERT INTO proveedor (nombre_proveedor, Telefono, Direccion )";
      $sql .= " VALUES ('{$pro_name}','{$pro_tel}','{$pro_direc}')";
      if($db->query($sql)){
        $session->msg("s", "Proveedor agregado exitosamente.");
        redirect('proveedor.php',false);
      } else {
        $session->msg("d", "Lo siento, registro falló");
        redirect('proveedor.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('proveedor.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>

  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
  </div>
   <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar proveedor</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="proveedor.php">
            <div class="form-group">
                <input type="text" class="form-control" name="proveedor-name" placeholder="Nombre del proveedor" required>
            </div>
            <div class="form-group">
                <input type="number" class="form-control" name="Telefono" placeholder="Telefono o Celular" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="Direccion" placeholder="Direccion" required>
            </div>
            <button type="submit" name="add_pro" class="btn btn-primary">Agregar proveedor</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Lista de proveedores</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Proveedores</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th class="text-center" style="width: 100px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_proveedores as $pro):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($pro['nombre_proveedor'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($pro['Telefono'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($pro['Direccion'])); ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_proveedor.php?id=<?php echo (int)$pro['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <script type="text/JavaScript">
                                            function confirmar() {
                                                var respuesta= confirm("¿Seguro que desea eliminar este proveedor?");
                                                if (respuesta==true) {
                                                    return true;
                                                }else{
                                                    return false;
                                                }
                                            }
                                        </script>
                        <a href="delete_proveedor.php?id=<?php echo (int)$pro['id'];?>"  class="btn btn-xs btn-danger" onclick="return confirmar()" data-toggle="tooltip" title="Eliminar">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                      </div>
                    </td>

                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
       </div>
    </div>
    </div>
   </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
