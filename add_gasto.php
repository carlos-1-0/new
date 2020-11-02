<?php
  $page_title = 'Agregar producto';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
 if(isset($_POST['add_gasto'])){
   $req_fields = array('Codigo','product-title','product-categorie','product-proveedor','product-quantity','buying-price', 'saleing-price' );
   validate_fields($req_fields);
   if(empty($errors)){
     $p_cod  = remove_junk($db->escape($_POST['Codigo']));
     $p_name  = remove_junk($db->escape($_POST['product-title']));
     $p_cat   = remove_junk($db->escape($_POST['product-categorie']));
     $p_pro   = remove_junk($db->escape($_POST['product-proveedor']));
   
     $p_qty   = remove_junk($db->escape($_POST['product-quantity']));
     $p_buy   = remove_junk($db->escape($_POST['buying-price']));
     $p_sale  = remove_junk($db->escape($_POST['saleing-price']));
     if (is_null($_POST['Estante']) || $_POST['Estante'] === "") {
      $p_est =0;
    } else {
      $p_est = remove_junk($db->escape($_POST['Estante']));
    }
     if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
       $media_id = '0';
     } else {
       $media_id = remove_junk($db->escape($_POST['product-photo']));
     }
     foreach ($codigo as $codi):
      $cadigoo=  remove_junk($codi['Codigo']);
     if ($cadigoo ==$p_cod) {
      echo "<script type='text/JavaScript'>
      alert('Codigo repetido por favor ingrese otro');
      
      </script>";
     }
      endforeach; 
     $date    = make_date();
     $query  = "INSERT INTO products (";
     $query .=" Codigo,name,quantity,Estante,buy_price,sale_price,categorie_id,proveedor_id,media_id,date";
     $query .=") VALUES (";
     $query .=" '{$p_cod}','{$p_name}', '{$p_qty}','{$p_est}', '{$p_buy}', '{$p_sale}', '{$p_cat}', '{$p_pro}', '{$media_id}', '{$date}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE Codigo='{$p_cod}'";
     if($db->query($query)){
       $session->msg('s',"Producto agregado exitosamente. ");
       redirect('add_product.php', false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('product.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_product.php',false);
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
            <span>Agregar gasto</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_product.php" class="clearfix">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                      <div class="input-group">
                      <span class="input-group-addon">
                      <i class="glyphicon glyphicon-th-large"></i>
                      </span>
                      <input type="text" class="form-control" name="gasto-title" placeholder="Descripción">
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                      <input type="number" class="form-control" name="gasto-price" placeholder="Valor gasto">
                      
                   </div>
                  </div>
                </div>
              </div>
              <button type="submit" name="add_gasto" class="btn btn-danger">Agregar producto</button>
              <a href="gastos.php" class="btn btn-success">Lista de gastos</a>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
