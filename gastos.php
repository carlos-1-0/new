<?php
  $page_title = 'Lista de gastos';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
$sales = find_all_sale();
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
        <div class="panel-heading clearfix">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Todas la ventas</span>
          </strong>
          <div class="pull-right">
            <a href="add_gasto.php" class="btn btn-primary">Agregar gasto</a>
          </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th class="text-center" style="width: 15%;"> Descripcion</th>
                <th class="text-center" style="width: 15%;"> Valor gasto </th>
                <th class="text-center" style="width: 15%;"> Fecha </th>
                <th class="text-center" style="width: 100px;"> Acciones </th>
             </tr>
            </thead>
           <tbody>
             <?php foreach ($sales as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td class="text-center"><a href="product.php"><?php echo remove_junk($sale['name']); ?></a></td>
               <td class="text-center"><?php echo $sale['Codigo']; ?></td>
               <form action="Buscar_cliente.php" method="get">
               <td class="text-center"><input type="submit" class="btn btn-success" name="Busqueda" id="Busqueda" value="<?php echo (int)$sale['cedula']; ?>"></td>
               </form>
               <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
               <td class="text-center">$ <?php echo remove_junk($sale['price']); ?></td>
               <td class="text-center">$ <?php echo remove_junk($sale['Total']); ?></td>
               <td class="text-center"><?php echo $sale['date']; ?></td>
               <td class="text-center">
                  <div class="btn-group">
                     <a href="edit_sale.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-warning btn-xs"  title="Edit" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-edit"></span>
                     </a>
                     <script type="text/JavaScript">
                                            function confirmar() {
                                                var respuesta= confirm("¿Seguro que desea eliminar esta venta?");

                                                if (respuesta==true) {
                                                    return true;
                                                }else{
                                                    return false;
                                                }
                                            }
                                        </script>
                     <a href="delete_sale.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-danger btn-xs" onclick="return confirmar()"  title="Delete" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-trash"></span>
                     </a>
                  </div>
               </td>
             </tr>
             <?php endforeach;?>
           </tbody>
         </table>
        </div>
      </div>
    </div>
  </div>
<?php include_once('layouts/footer.php'); ?>
