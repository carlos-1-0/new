<?php
  $page_title = 'Lista de clientes';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $clientes = join_cliente_table();
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <div class="pull-right">
           <a href="add_cliente.php" class="btn btn-primary">Agregar cliente</a>
         </div>
         <div class="pull-left">
                        <form action="Buscar_cliente.php" method="GET" class="form_search">
                            <input type="text" name="Busqueda" id="Busqueda" placeholder="Buscar">
                            <input type="submit" value="Buscar" class="btn btn-primary btn_search">
                        </form>
                    </div> 
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                
                <th class="text-center" style="width: 10%;"> Nombre </th>
                <th class="text-center" style="width: 50px;">Cedula</th>
                <th class="text-center" style="width: 10%;"> Celular </th>
                <th class="text-center" style="width: 10%;"> Direccion </th>
                <th class="text-center" style="width: 10%;"> Historial </th>
                <th class="text-center" style="width: 100px;"> Acciones </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($clientes as $cliente):?>
              <tr>
               
                <td class="text-center" > <?php echo remove_junk($cliente['name']); ?></td>
                <td><center> <?php echo remove_junk($cliente['id']); ?></center></td>
                <td class="text-center"> <?php echo remove_junk($cliente['celular']); ?></td>
                <td class="text-center"> <?php echo remove_junk($cliente['direccion']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="Historial_cliente.php?id=<?php echo (int)$cliente['id'];?>" class="btn btn-secondary"  title="Historial" data-toggle="tooltip">
                    <span class="glyphicon glyphicon-list-alt"></span>
                  </a>
                  </div> 
                </td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_cliente.php?id=<?php echo (int)$cliente['id'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <script type="text/JavaScript">
                                            function confirmar() {
                                                var respuesta= confirm("¿Seguro que desea eliminar este cliente?");

                                                if (respuesta==true) {
                                                    return true;
                                                }else{
                                                    return false;
                                                }
                                            }
                                        </script>
                     <a href="delete_cliente.php?id=<?php echo (int)$cliente['id'];?>" class="btn btn-danger btn-xs" onclick="return confirmar()" title="Eliminar" data-toggle="tooltip">
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
