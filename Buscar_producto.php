<?php
  $page_title = 'Lista de ventas';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  
?>
    <?php include_once('layouts/header.php'); ?>
    <div class="row">
        <div class="col-md-12">
            <?php echo display_msg($msg); ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="panel panel-default">
                <?php 
                    $Busqueda= $_REQUEST['Busqueda'];
                     
                    if (empty($Busqueda)) {
                      header("location: product.php");
                    }
                    $products = join_product_busque($Busqueda);

                ?>
                <div class="panel-heading clearfix">
                    <div class="pull-right">
                        <a href="add_product.php" class="btn btn-primary">Agregar producto</a>
                    </div>
                    <div class="pull-left">
                        <form action="Buscar_producto.php" method="GET" class="form_search">
                            <input type="text" name="Busqueda" id="Busqueda" placeholder="Buscar" value=" <?php echo $Busqueda;?> ">
                            <input type="submit" value="Buscar" class="btn btn-primary btn_search">
                            <a href="product.php" class="btn btn-success">Todos</a>
                        </form>
                    </div>
                    
                </div>

                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th> Imagen</th>
                                <th> Codigo </th>
                                <th> Descripción </th>
                                <th class="text-center" style="width: 10%;"> Categoría </th>
                                <th class="text-center" style="width: 10%;"> Proveedor </th>
                                <th class="text-center" style="width: 10%;"> Estante </th>
                                <th class="text-center" style="width: 10%;"> Cantidad existente </th>
                                <th class="text-center" style="width: 10%;"> Precio de compra </th>
                                <th class="text-center" style="width: 10%;"> Precio de venta </th>
                                <th class="text-center" style="width: 10%;"> Agregado </th>
                                <th class="text-center" style="width: 100px;"> Acciones </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product):?>
                            <tr>
                                <td class="text-center">
                                    <?php echo count_id();?>
                                </td>
                                <td>
                                    <?php if($product['media_id'] === '0'): ?>
                                    <img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
                                    <?php else: ?>
                                    <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo remove_junk($product['Codigo']); ?>
                                </td>
                                <td class="text-center">
                                    <?php echo remove_junk($product['name']); ?>
                                </td>
                                <td class="text-center">
                                    <?php echo remove_junk($product['categorie']); ?>
                                </td>
                                <td class="text-center">
                                    <?php echo remove_junk($product['proveedor']); ?>
                                </td>
                                <td class="text-center">
                                    <?php echo remove_junk($product['Estante']); ?>
                                </td>
                                <?php if ($product['quantity']<=5) {?>
                                <td class="text-center" style="color: red; font-weight:bold;">
                                    <?php echo remove_junk($product['quantity']); ?>
                                </td>
                                <?php } else {?>
                                <td class="text-center" style="color: black; font-weight:bold;">
                                    <?php echo remove_junk($product['quantity']); ?>
                                </td>
                                <?php }?>
                                <td class="text-center" style="color: blue; font-weight:bold;">
                                    <?php echo remove_junk($product['buy_price']); ?>
                                </td>
                                <td class="text-center" style="color: green; font-weight:bold;">
                                    <?php echo remove_junk($product['sale_price']); ?>
                                </td>
                                <td class="text-center">
                                    <?php echo read_date($product['date']); ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs" title="Editar" data-toggle="tooltip">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs" title="Eliminar" data-toggle="tooltip">
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
    <?php include_once('layouts/footer.php'); ?>