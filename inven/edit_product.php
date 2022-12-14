<?php
  $page_title = 'Editar producto';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
$product = find_by_id('products',(int)$_GET['id']);
$all_categories = find_all('categories');
$all_photo = find_all('media');
if(!$product){
  $session->msg("d","Missing product id.");
  redirect('product.php');
}
?>
<?php
 if(isset($_POST['product'])){
    $req_fields = array('lote','product-categorie','stock','invima',  'producto', 'presentacion', 'proveedor',  'vencimiento', 'marca' );
    validate_fields($req_fields);

   if(empty($errors)){
       
       $p_lote = remove_junk($db->escape($_POST['lote']));
       $p_cat   = (int)$_POST['product-categorie'];
       $p_stock  = remove_junk($db->escape($_POST['stock']));
       $p_invima   = remove_junk($db->escape($_POST['invima']));
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
       $query   = "UPDATE products SET";
       $query  .=" lote ='{$p_lote}', stock ='{$p_stock}',";
       $query  .=" invima ='{$p_invima}', producto ='{$p_producto}', presentacion ='{$p_presentacion}', proveedor ='{$p_proveedor}', vencimiento ='{$p_vencimiento}' marca ='{$p_marca}', categorie_id ='{$p_cat}',media_id='{$media_id}'";
       $query  .=" WHERE id ='{$product['id']}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Producto ha sido actualizado. ");
                 redirect('product.php', false);
               } else {
                 $session->msg('d',' Lo siento, actualizaci??n fall??.');
                 redirect('edit_product.php?id='.$product['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_product.php?id='.$product['id'], false);
   }

 }

?>
<?php include_once('layouts/header.php'); ?>

  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">
<div class="col-md-11">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Editar producto</span>
         </strong>
        </div>
        <div class="row">
        <div class="panel-body">
         <div class="col-md-11">
           <form method="post" action="edit_product.php?id=<?php echo (int)$product['id'] ?>">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-pencil"></i>
                  </span>
                  <input type="text" class="form-control" style="width: 100%"  name="producto" value="<?php echo remove_junk($product['producto']);?>">
                 
               </div>
              </div>




              <div class="col-md-4">
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
                       <i class="glyphicon glyphicon-info-sign"></i>
                     </span>
                     <input type="text" class="form-control" name="lote" placeholder="Lote">
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
                     <input type="text" class="form-control" style="width: 100%" name="proveedor" placeholder="proveedor">
                  </div>
                 </div>

                 
</br>

              <div class="panel-body">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="product-categorie">
                    <option value="">Selecciona una categor??a</option>
                   <?php  foreach ($all_categories as $cat): ?>
                     <option value="<?php echo (int)$cat['id']; ?>" <?php if($product['categorie_id'] === $cat['id']): echo "selected"; endif; ?> >
                       <?php echo remove_junk($cat['name']); ?></option>
                   <?php endforeach; ?>
                 </select>
                  </div>
                  <div class="col-md-6">
                    <select class="form-control" name="product-photo">
                      <option value=""> Sin imagen</option>
                      <?php  foreach ($all_photo as $photo): ?>
                        <option value="<?php echo (int)$photo['id'];?>" <?php if($product['media_id'] === $photo['id']): echo "selected"; endif; ?> >
                          <?php echo $photo['file_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  </br></br>

                 

                </div>
              </div>



              


              <div class="form-group">
               <div class="row">
               <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-grain"></i>
                     </span>
                     <input type="text" class="form-control" name="marca" placeholder="Marca">
                  </div>
                 </div>





                 <div class="col-md-4">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon">
                       <i class="glyphicon glyphicon-shopping-cart"></i>
                      </span>
                      <input type="number" class="form-control" name="stock" value="<?php echo remove_junk($product['stock']); ?>">
                   </div>
                  </div>
                 </div>


                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-trash"></i>
                     </span>
                     <input type="date" class="form-control" name="vencimiento" placeholder="vencimiento">
                  </div>
                 </div>



               </div>
              </div>
              <button type="submit" name="product" class="btn btn-danger">Actualizar</button>
          </form>
         </div>
        </div>
      </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
