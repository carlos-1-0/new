<?php
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
?>

<?php
 // Auto suggetion
    $html = '';
   if(isset($_POST['product_name']) && strlen($_POST['product_name']))
   {
     $products = find_product_by_title1($_POST['product_name']);
     if($products){
        foreach ($products as $product):
           $html .= "<li class=\"list-group-item\">";
           $html .= $product['name'];
           $html .= "</li>";
         endforeach;
      } else {

        $html .= '<li onClick=\"fill(\''.addslashes().'\')\" class=\"list-group-item\">';
        $html .= 'No encontrado';
        $html .= "</li>";

      }

      echo jsonr_encode($html);
   }
 ?>
 <?php
 // find all product
  if(isset($_POST['p_name']) && strlen($_POST['p_name']))
  {
    $product_title = remove_junk($db->escape($_POST['p_name']));
    if($results = join_product_table_1($product_title)){
        foreach ($results as $result) {

          $html .= "<tr>";
 
          $html .= "<td id=\"p_name\">".$result['name']."</td>";
          $html .= "<td id=\"s_id\">".$result['id']."</td>";
          $html .= "<td id=\"Estante\">".$result['Estante']."</td>";
          $html .= "<td id=\"s_price\">".$result['sale_price']."</td>";
          $html .= "<td id=\"s_total\">".$result['']."</td>";
         
         
        }
    } else {
        $html ='<tr><td>El producto no se encuentra registrado en la base de datos</td></tr>';
    }

    echo jsonr_encode($html);
  }
 ?>
