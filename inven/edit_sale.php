<?php
  $page_title = 'Edit sale';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
$sale = find_by_id('sales',(int)$_GET['id']);
if(!$sale){
  $session->msg("d","Missing product id.");
  redirect('sales.php');
}
?>
<?php $product = find_by_id('products',$sale['product_id']); ?>
<?php

  if(isset($_POST['update_sale'])){
    $req_fields = array('lote','stock','producto','proveedor','presentacion','proveedor','marca','vencimiento','total', 'date' );
    validate_fields($req_fields);
        if(empty($errors)){
          $p_id      = $db->escape((int)$product['id']);
        
          $p_lote   = $db->escape((int)$_POST['lote']);
          $p_stock    = $db->escape((int)$_POST['stock']);
          $s_total   = $db->escape($_POST['total']);
          $p_producto   = $db->escape($_POST['producto']);
          $p_producto   = $db->escape($_POST['proveedor']);
          $p_presentacion   = $db->escape($_POST['presentacion']);
          $p_marca  = $db->escape($_POST['marca']);
          $p_vencimiento   = $db->escape($_POST['vencimiento']);
          $date      = $db->escape($_POST['date']);
          $s_date    = date("Y-m-d", strtotime($date));

          $sql  = "UPDATE sales SET";
          $sql .= " product_id= '{$p_id}',lote={$p_lote},stock={$p_stock},producto={$p_producto},presentacion={$p_presentacion},proveedor={$p_proveedor},marca={$p_marca},vencimiento={$p_vencimiento},price='{$s_total}',date='{$s_date}'";
          $sql .= " WHERE id ='{$sale['id']}'";
          $result = $db->query($sql);
          if( $result && $db->affected_rows() === 1){
                    update_product_stock($p_stock,$p_id);
                    $session->msg('s',"Sale updated.");
                    redirect('edit_sale.php?id='.$sale['id'], false);
                  } else {
                    $session->msg('d',' Sorry failed to updated!');
                    redirect('sales.php', false);
                  }
        } else {
           $session->msg("d", $errors);
           redirect('edit_sale.php?id='.(int)$sale['id'],false);
        }
  }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">

  <div class="col-md-12">
  <div class="panel">
    <div class="panel-heading clearfix">
      <strong>
        <span class="glyphicon glyphicon-th"></span>
        <span>All Sales</span>
     </strong>
     <div class="pull-right">
       <a href="sales.php" class="btn btn-primary">Show all sales</a>
     </div>
    </div>
    <div class="panel-body">
       <table class="table table-bordered">
         <thead>
          
          <th> stock </th>
          <th> producto</th>
          <th> presentacion </th>
          <th> proveedor </th>
          <th> marca </th>
          <th> vencimiento </th>
        
          <th> Total </th>
          <th> Date</th>
          <th> Action</th>
         </thead>
           <tbody  id="product_info">
              <tr>
              <form method="post" action="edit_sale.php?id=<?php echo (int)$sale['id']; ?>">
                

                <td id="p_lote">
                  <input type="text" class="form-control" name="lote" value="<?php echo (int)$sale['lote']; ?>">
                </td>
                
                <td id="p_stock">
                  <input type="text" class="form-control" name="stock" value="<?php echo (int)$sale['stock']; ?>">
                </td>
                <td id="p_producto">
                  <input type="text" class="form-control" name="producto" value="<?php echo (int)$sale['producto']; ?>">
                </td>
                <td id="p_presentacion">
                  <input type="text" class="form-control" name="presentacion" value="<?php echo (int)$sale['presentacion']; ?>">
                </td>
                <td id="p_proveedor">
                  <input type="text" class="form-control" name="proveedor" value="<?php echo (int)$sale['proveedor']; ?>">
                </td>
                
                <td id="p_marca">
                  <input type="text" class="form-control" name="marca" value="<?php echo (int)$sale['marca']; ?>">
                </td>
                <td id="p_vencimiento">
                  <input type="text" class="form-control" name="vencimiento" value="<?php echo (int)$sale['vencimiento']; ?>">
                </td>
              
                <td>
                  <input type="text" class="form-control" name="total" value="<?php echo remove_junk($sale['price']); ?>">
                </td>
                <td id="s_date">
                  <input type="date" class="form-control datepicker" name="date" data-date-format="" value="<?php echo remove_junk($sale['date']); ?>">
                </td>
                <td>
                  <button type="submit" name="update_sale" class="btn btn-primary">Update sale</button>
                </td>
              </form>
              </tr>
           </tbody>
       </table>

    </div>
  </div>
  </div>

</div>

<?php include_once('layouts/footer.php'); ?>
