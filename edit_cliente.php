<?php
  $page_title = 'Editar cliente';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
    <?php
$cliente = find_by_id('cliente',(int)$_GET['id']);
/* $all_categories = find_all('categories');
$all_photo = find_all('media'); */
if(!$cliente){
  $session->msg("d","No se encuentra la cedula del cliente.");
  redirect('cliente.php');
}
?>
        <?php
 if(isset($_POST['client'])){
    $req_fields = array('name','celular','direccion' );
    validate_fields($req_fields);

   if(empty($errors)){
       $p_name  = remove_junk($db->escape($_POST['name']));
       $p_qty   = remove_junk($db->escape($_POST['celular']));
       $p_sale  = remove_junk($db->escape($_POST['direccion']));
      
       $query   = "UPDATE cliente SET";
       $query  .=" name ='{$p_name}',celular='{$p_qty}',";
       $query  .=" direccion ='{$p_sale}'";
       $query  .=" WHERE id ='{$cliente['id']}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Los datos del cliente han sido actualizados. ");
                 redirect('cliente.php', false);
               } else {
                 $session->msg('d',' Lo siento, actualización falló.');
                 redirect('edit_cliente.php?id='.$cliente['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_cliente.php?id='.$cliente['id'], false);
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
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Editar cliente</span>
         </strong>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <form method="post" action="edit_cliente.php?id=<?php echo (int)$cliente['id']?>">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                         <i class="glyphicon glyphicon-pencil"></i>
                                        </span>
                                        <input type="text" class="form-control" name="name" value="<?php echo remove_junk($cliente['name']);?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="qty">Celular</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                  <i class="glyphicon glyphicon-shopping-cart"></i>
                                                </span>
                                                <input type="number" class="form-control" name="celular" value="<?php echo remove_junk($cliente['celular']); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="qty">Direccion</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon"></i>
                                                    </span>
                                                <input type="text" class="form-control" name="direccion" value="<?php echo remove_junk($cliente['direccion']);?>">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <button type="submit" name="client" class=" btn btn-danger">Actualizar</button>
                                    <a href="cliente.php" class="btn btn-success">Volver</a>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include_once('layouts/footer.php'); ?>