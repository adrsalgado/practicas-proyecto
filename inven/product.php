<?php
  $page_title = 'Lista de productos';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $products = join_product_table();
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
           <a href="add_product.php" class="btn btn-primary">Agregar producto</a>
         </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">

          

            <thead>
              <tr>
                
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
  </div>
</div>
                <th class="text-center" style="width: 50px;">#</th>
                <th class="text-center" style="width: 150px;">Imagen </th>
                <th class="text-center" style="width: 150px;">Producto </th>
                <th class="text-center" style="width: 150px;"> Lote</th>
                <th class="text-center" style="width: 150px;"> Invima </th>
                <th class="text-center" style="width: 150px;"> Presentación </th>
                <th class="text-center" style="width: 150px;"> Proveedor </th>
                <th class="text-center" style="width: 150px;"> Categoría </th>
                <th class="text-center" style="width: 150px;"> Marca </th>
                <th class="text-center" style="width: 150px;"> Stock </th>
                <th class="text-center" style="width: 150px;"> Vencimiento </th>
                <th class="text-center" style="width: 150px;"> Agregado </th>
                <th class="text-center" style="width: 100px;"> Acciones </th>
                
              </tr>
            </thead>
            <tbody>
           


              <?php foreach ($products as $product):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td>
                  <?php if($product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                <?php endif; ?>
                </td>
                <td class="text-center"> <?php echo remove_junk($product['producto']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['lote']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['invima']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['presentacion']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['proveedor']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['categorie']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['marca']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['stock']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['vencimiento']); ?></td>
                <td class="text-center"> <?php echo read_date($product['date']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                     <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
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
