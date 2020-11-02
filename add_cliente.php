<?php
  $page_title = 'Agregar Cliente';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
 
?>
<?php
 if(isset($_POST['add_cliente'])){
   $req_fields = array('name','cedula','celular','direccion');
   validate_fields($req_fields);
   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['name']));
     $p_cat   = remove_junk($db->escape($_POST['cedula']));
     $p_qty   = remove_junk($db->escape($_POST['celular']));
     $p_buy   = remove_junk($db->escape($_POST['direccion']));
    
     $date    = make_date();
     $query  = "INSERT INTO cliente (";
     $query .=" id,name,celular,direccion";
     $query .=") VALUES (";
     $query .=" '{$p_cat}','{$p_name}', '{$p_qty}', '{$p_buy}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE name='{$p_name}'";
     if($db->query($query)){
       $session->msg('s',"Cliente agregado exitosamente. ");
       redirect('add_cliente.php', false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('product.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_cliente.php',false);
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
  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar Cliente</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_cliente.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-pencil"></i>
                  </span>
                  <input type="text" class="form-control" name="name" placeholder="Nombre">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                  <span class="input-group-addon">
                      <i class="glyphicon glyphicon-user"></i>
                     </span>
                     <input type="number" class="form-control" name="cedula" placeholder="Cedula">
                  </div>
                </div>
              </div>

              <div class="form-group">
               <div class="row">
                 <div class="col-md-6">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-phone"></i>
                     </span>
                     <input type="number" class="form-control" name="celular" placeholder="Celular">
                  </div>
                 </div>
                 <div class="col-md-6">
                   <div class="input-group">
                     <span class="input-group-addon">
                     <i class="glyphicon glyphicon-home"></i>
                     </span>
                     <input type="text" class="form-control" name="direccion" placeholder="Direccion">
                     
                  </div>
                 </div>
               </div>
              </div>
              <button type="submit" name="add_cliente" class="btn btn-info">Agregar Cliente</button>
              <a href="cliente.php" class="btn btn-success">Ver clientes</a>
            </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
