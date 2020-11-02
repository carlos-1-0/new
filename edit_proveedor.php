<?php
  $page_title = 'Editar categoría';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  //Display all catgories.
  $proveedor = find_by_id('proveedor',(int)$_GET['id']);
  if(!$proveedor){
    $session->msg("d","Falta Id del proveedor.");
    redirect('proveedor.php');
  }
?>

<?php
if(isset($_POST['edit_pro'])){
  $req_field = array('proveedor_name','Telefono','Direccion');
  validate_fields($req_field);
  $pro_name = remove_junk($db->escape($_POST['proveedor_name']));
  $pro_tel = remove_junk($db->escape($_POST['Telefono']));
  $pro_dire = remove_junk($db->escape($_POST['Direccion']));
  if(empty($errors)){
        $sql = "UPDATE proveedor SET nombre_proveedor='{$pro_name}', Telefono='{$pro_tel}', Direccion='{$pro_dire}'";
       $sql .= " WHERE id='{$proveedor['id']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Proveedor actualizado con éxito.");
       redirect('proveedor.php',false);
     } else {
       $session->msg("d", "Lo siento, actualización falló.");
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
   <div class="col-md-5">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Editando <?php echo remove_junk(ucfirst($proveedor['nombre_proveedor']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_proveedor.php?id=<?php echo (int)$proveedor['id'];?>">
           <div class="form-group">
               <input type="text" class="form-control" name="proveedor_name" value="<?php echo remove_junk(ucfirst($proveedor['nombre_proveedor']));?>">
           </div>
           <div class="form-group">
               <input type="text" class="form-control" name="Telefono" value="<?php echo remove_junk(ucfirst($proveedor['Telefono']));?>">
           </div>
           <div class="form-group">
               <input type="text" class="form-control" name="Direccion" value="<?php echo remove_junk(ucfirst($proveedor['Direccion']));?>">
           </div>
           <button type="submit" name="edit_pro" class="btn btn-primary">Actualizar proveedor</button>
           <a href="proveedor.php" class="btn btn-success">Volver</a>
          </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>
