<?php
  $page_title = 'Agregar venta';
  require_once('includes/load.php');
  // Checkin ¿Qué nivel de usuario tiene permiso para ver esta página?
   page_require_level(3);
?>
<?php

  if(isset($_POST['add_sale'])){
    $req_fields = array('producto','stock','lote','vencimiento', 'date' );
    validate_fields($req_fields);
        if(empty($errors)){
          $p_producto      = $db->escape((int)$_POST['producto']);
          $p_stock     = $db->escape((int)$_POST['stock']);
          $p_lote     = $db->escape((int)$_POST['lote']);
          $p_vencimiento   = $db->escape($_POST['vencimiento']);
          $date      = $db->escape($_POST['date']);
          $s_date    = make_date();

          $sql  = "INSERT INTO sales (";
          $sql .= " product_id,producto,stock,vencimiento,date";
          $sql .= ") VALUES (";
          $sql .= "'{$p_id}','{$p_producto}','{$p_lote}','{$p_stock}','{$p_vencimiento}','{$s_date}'";
          $sql .= ")";

                if($db->query($sql)){
                  update_product_stock($p_stock,$p_producto);
                  $session->msg('s',"Venta agregada ");
                  redirect('add_sale.php', false);
                } else {
                  $session->msg('d','Lo siento, registro falló.');
                  redirect('add_sale.php', false);
                }
        } else {
           $session->msg("d", $errors);
           redirect('add_sale.php',false);
        }
  }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-18">
    <?php echo display_msg($msg); ?>
    <form method="post" action="ajax.php" autocomplete="off" id="sug-form">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-primary">Búsqueda</button>
            </span>
            <input type="text" id="sug_input" class="form-control" name="producto"  placeholder="Buscar por el nombre del producto">
         </div>
         <div id="result" class="list-group"></div>
        </div>
    </form>

    </n></br>
  <div class="col-md-14">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Agregar Pedido</span>
       </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_sale.php">
         <table class="table table-bordered">
           <thead>
            <th class="text-center" style="width: 25%;"> Producto </th>
            <th class="text-center" style="width: 9%;"> Cantidad </th>
            <th class="text-center" style="width: 8%;"> Lote </th>
            <th class="text-center" style="width: 15%;"> Vencimiento </th>
            <th class="text-center" style="width: 15%;"> Agregado</th>
            <th class="text-center" style="width: 9%;"> Acciones</th>
           </thead>
             <tbody  id="product_info"> </tbody>
         </table>
       </form>
      </div>
    </div>
  </div>

  </div>
</div>




</div>

<?php include_once('layouts/footer.php'); ?>
