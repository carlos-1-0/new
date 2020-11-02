<?php
  $page_title = 'Agregar venta';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php

  if(isset($_POST['add_sale'])){
    $req_fields = array('s_id','Codigo','cedula','quantity','price','total', 'date' );
    validate_fields($req_fields);
        if(empty($errors)){ 
          $p_id      = $db->escape((int)$_POST['s_id']);
          $s_cod  = $db->escape($_POST['Codigo']);
          $s_cedu    = $db->escape((int)$_POST['cedula']);
          $s_qty     = $db->escape((int)$_POST['quantity']);
          $s_pri     = $db->escape((int)$_POST['price']);
          $s_total   = $db->escape($_POST['total']);
          $date      = $db->escape($_POST['date']);
          $s_date    = make_date();
         
          $sql  = "INSERT INTO sales (";
          $sql .= " product_id,Codigo,cedula,qty,price,Total,date";
          $sql .= ") VALUES (";
          $sql .= "'{$p_id}','{$s_cod}','{$s_cedu}','{$s_qty}','{$s_pri}','{$s_total}','{$s_date}'";
          $sql .= ")";
          dato($p_id);
          // cantidad($s_qty,$p_id);
          $cantidad_base = dato($p_id);
          foreach ($cantidad_base as $cati):
            $cantindas=remove_junk(ucfirst($cati['quantity']));
          
           if ($s_qty == 0) {
            $session->msg('d','Cantidad mal ingresada');
            redirect('sales.php');
            die();
            }elseif ($s_qty>$cantindas) {
                $session->msg('d','Cantidad no disponible');
                redirect('sales.php');
            }elseif ($s_qty<=$cantindas) {
              if($db->query($sql)){
                  update_product_qty($s_qty,$p_id);
                  $session->msg('s',"Venta agregada ");
                  redirect('add_sale.php', false);
                }
            }
          endforeach;   
        } else {
           $session->msg("d", $errors);
           redirect('add_sale.php',false);
        }
  }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
    <form method="post" action="ajax.php" autocomplete="off" id="sug-form">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-primary">Búsqueda</button>
            </span>
            <input type="text" id="sug_input" class="form-control" name="title"  placeholder="Buscar por el nombre del producto">
         </div>
         <div id="result" class="list-group"></div> 
        </div>
    </form>
  </div>
</div>
<div class="row">

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong> 
          <span class="glyphicon glyphicon-th"></span>
          <span>Agregar venta</span>
       </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_sale.php">
         <table class="table table-bordered">
           <thead>
            <th> Producto </th>
            <th> Codigo </th>
            <th> Cedula</th>
            <th> Precio </th>
            <th> Cantidad </th>
            <th> Total </th>
            <th> Agregado</th>
            <th> Acciones</th>
            
           </thead>
             <tbody  id="product_info"> </tbody>
         </table>
       </form>
      </div>
    </div>
  </div>

</div>

<?php include_once('layouts/footer.php'); ?>
