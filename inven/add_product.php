<?php
  $page_title = 'Agregar producto';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $all_categories = find_all('categories');
  $all_photo = find_all('media');
?>
<?php
 if(isset($_POST['add_product'])){
   $req_fields = array('lote','product-categorie','stock','invima', 'producto', 'presentacion','proveedor',  'vencimiento',  'marca');
   validate_fields($req_fields);
   if(empty($errors)){
    
     $p_cat   = remove_junk($db->escape($_POST['product-categorie']));
     $p_lote  = remove_junk($db->escape($_POST['lote']));
     $p_stock  = remove_junk($db->escape($_POST['stock']));
     $p_invima  = remove_junk($db->escape($_POST['invima']));

     $p_producto  = remove_junk($db->escape($_POST['producto']));
     $p_presentacion  = remove_junk($db->escape($_POST['presentacion']));
     $p_proveedor  = remove_junk($db->escape($_POST['proveedor']));

     $p_vencimiento  = remove_junk($db->escape($_POST['vencimiento']));
     $p_marca  = remove_junk($db->escape($_POST['marca']));

     if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
       $media_id = '0';
     } else {
       $media_id = remove_junk($db->escape($_POST['product-photo']));
     }
     $date    = make_date();
     $query  = "INSERT INTO products (";
     $query .=" lote,stock,invima,producto,presentacion,proveedor,vencimiento,marca,categorie_id,media_id,date";
     $query .=") VALUES (";
     $query .="  '{$p_lote}','{$p_stock}', '{$p_invima}',  '{$p_producto}','{$p_presentacion}', '{$p_marca}', '{$p_proveedor}', '{$p_vencimiento}', '{$p_cat}', '{$media_id}', '{$date}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE producto='{$p_producto}'";
     if($db->query($query)){
       $session->msg('s',"Producto agregado exitosamente. ");
       redirect('add_product.php', false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('product.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_product.php',false);
   }

 }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="	glyphicon glyphicon-plus"></span>
            <span>Agregar producto</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_product.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-pencil"></i>
                  </span>
                  <input type="text" class="form-control" style="width: 60%" name="producto" placeholder="Producto">
                  </div>
                 </div>



                 <div class="col-md-2">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-list-alt"></i>
                     </span>
                     <input type="text" class="form-control"  name="lote" placeholder="Lote">
                  </div>
                 </div>





                 <div class="col-md-2">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-barcode"></i>
                     </span>
                     <input type="text" class="form-control" name="invima" placeholder="Invima">
                  </div>
                 </div>


                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-list-alt"></i>
                     </span>
                     <input type="text" class="form-control" name="presentacion" placeholder="presentacion">
                  </div>
                 </div>

                 </br></br>


                 <div class="panel-body">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-user"></i>
                     </span>
                     <input type="text" class="form-control" style="width: 60%" name="proveedor" placeholder="Proveedor">
                  </div>
                 </div>


               </div>
              </div>
              
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4">
                    <select class="form-control" name="product-categorie">
                      <option value="">Selecciona una categoría</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <select class="form-control" name="product-photo">
                      <option value="">Selecciona una imagen</option>
                    <?php  foreach ($all_photo as $photo): ?>
                      <option value="<?php echo (int)$photo['id'] ?>">
                        <?php echo $photo['file_name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  

                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-grain"></i>
                     </span>
                     <input type="text" class="form-control" name="marca" placeholder="Marca">
                  </div>
                 </div>
                </div>
              </div>

              

              <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                     </span>
                     <input type="number" class="form-control" name="stock" placeholder="Cantidad">
                  </div>
                 </div>


                



                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-trash"></i>
                      </span>
                      <input type="date" class="form-control" name="vencimiento" placeholder="Vencimiento ">
                   </div>
                  </div>


                  
               </div>
              </div>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <button type="submit" name="add_product" class="btn btn-info">Agregar producto</button>
              

          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
