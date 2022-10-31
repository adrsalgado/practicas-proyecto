<?php
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
?>

<?php
 // Auto suggetion
    $html = '';
   if(isset($_POST['p_cat']) && strlen($_POST['p_cat']))
   {
     $products = find_product_by_title($_POST['p_cat']);
     if($products){
        foreach ($products as $product):
           $html .= "<li class=\"list-group-item\">";
           $html .= $product['categorie_id'];
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
 //encontrar todo el producto
  if(isset($_POST['categorie_id']) && strlen($_POST['categorie_id']))
  {
    $p_cat = remove_junk($db->escape($_POST['categorie_id']));
    if($results = find_all_product_info_by_title($p_cat)){
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
        $html ='<tr><td>La categoria no se encuentra registrada en la base de datos</td></tr>';
    }

    echo json_encode($html);
  }
 ?>
