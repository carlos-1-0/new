<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  $cliente = find_by_cc('cliente',(int)$_GET['id']);
  if(!$cliente){
    $session->msg("d","ID vacío");
    echo "tu puta MADRE";
    redirect('cliente.php');
  }
?>
<?php
  $delete_id = delete_by_cc('cliente',(int)$cliente['id']);
  if($delete_id){
      $session->msg("s","cliente eliminado con exito");
      redirect('cliente.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('cliente.php');
  }
?>
