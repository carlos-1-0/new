<?php
  $page_title = 'Venta diaria';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>

<?php
 $month = date('m');
 $sales = mesSales($month); 
?> 
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Ventas  mensuales-  Mes:</span>
            <span style="color:orange"> <?php echo date("m/Y"); ?></span>
         
          </strong>
        </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th class="text-center" style="width: 100px;"> Codigo</th>
                <th class="text-center" style="width: 15%;"> Descripción </th>
                <th class="text-center" style="width: 15%;"> Cedula cliente</th>
                <th class="text-center" style="width: 15%;"> Cantidad vendida</th>
                <th class="text-center" style="width: 15%;"> Precio de venta</th>  
                <th class="text-center" style="width: 15%;"> Total </th>
                <th class="text-center" style="width: 15%;"> Fecha </th>
             </tr>
            </thead>
           <tbody>
             <?php foreach ($sales as $sale):?>
             <tr>
             <td class="text-center"><?php echo count_id();?></td>
             <td><?php echo remove_junk($sale['Codigo']); ?></td>
               <td><?php echo remove_junk($sale['name']); ?></td>
               <form action="Buscar_cliente.php" method="get">
               <td class="text-center"><input type="submit" class="btn btn-success" name="Busqueda" id="Busqueda" value="<?php echo (int)$sale['cedula']; ?>"></td>
               </form>
               <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
               <td class="text-center">$ <?php echo remove_junk($sale['price']); ?></td>
               <td class="text-center">$ <?php echo remove_junk($sale['Total']); ?></td>
               <td class="text-center" style="color: orange; font-weight:bold;"><?php echo date("d/m/Y", strtotime ($sale['date'])); ?></td>
              
             </tr>
             <?php endforeach;?>
           </tbody>
         </table>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
