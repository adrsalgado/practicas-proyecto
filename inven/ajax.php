<?php
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
?>

<?php
 // Auto suggetion
    $html = '';
   if(isset($_POST['product_name']) && strlen($_POST['product_name']))
   {
     $products = find_product_by_title($_POST['product_name']);
     if($products){
        foreach ($products as $product):
           $html .= "<li class=\"list-group-item\">";
           $html .= $product['name'];
           $html .= "</li>";
         endforeach;
      } else {

        
        $html .= 'No encontrado';
        $html .= "</li>";

      }

      echo json_encode($html);
   }
 ?>
 <?php
 // find all product
  if(isset($_POST['p_name']) && strlen($_POST['p_name']))
  {
    $product_name = remove_junk($db->escape($_POST['p_name']));
    if($results = find_all_product_info_by_title($product_name)){
        foreach ($results as $result) {

          $html .= "<tr>";

          $html .= "<td id=\"p_producto\">".$result['producto']."</td>";
          $html  .= "<td>";
          $html .= "<input type=\"hidden\" name=\"p.lote\" value=\"{$result['lote']}\">";
          $html  .= "<td>";
          $html .= "<input type=\"hidden\" name=\"s_id\" value=\"{$result['id']}\">";
          $html  .= "<td>";
          $html .= "<input type=\"hidden\" name=\"p.presentacion\" value=\"{$result['presentacion']}\">";
          $html  .= "<td>";
          $html .= "<input type=\"hidden\" name=\"p.proveedor\" value=\"{$result['proveedor']}\">";
          $html  .= "<td>";
         
          $html .= "<input type=\"hidden\" name=\"p.marca\" value=\"{$result['marca']}\">";
          $html  .= "<td>";
          $html .= "<input type=\"hidden\" name=\"p.vencimiento\" value=\"{$result['vencimiento']}\">";
          $html  .= "<td>";
          $html .= "<td id=\"p.stock\">";
          $html .= "<input type=\"text\" class=\"form-control\" name=\"stock\" value=\"1\">";
          $html  .= "</td>";
          $html  .= "<td>";
          $html  .= "<input type=\"text\" class=\"form-control\" name=\"total\" value=\"{$result['sale_price']}\">";
          $html  .= "</td>";
          $html  .= "<td>";
          $html  .= "<input type=\"date\" class=\"form-control datePicker\" name=\"date\" data-date data-date-format=\"yyyy-mm-dd\">";
          $html  .= "</td>";
          $html  .= "<td>";
          $html  .= "<button type=\"submit\" name=\"add_sale\" class=\"btn btn-primary\">Agregar</button>";
          $html  .= "</td>";
          $html  .= "</tr>";

        }
    } else {
        $html ='<tr><td>El producto no se encuentra registrado en la base de datos</td></tr>';
    }

    echo json_encode($html);
  }
 ?>
