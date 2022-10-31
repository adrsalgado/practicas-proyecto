<?php
  $page_title = 'Prosalco IPS' ;
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-120">
    <?php echo display_msg($msg); ?>
  </div>
 <div class="col-md-120">
    <div class="panel">
      <div class="jumbotron text-center">
         <h1>Bienvenido al inventario de prosalco </h1>
     
      </div>
    </div>
 </div>
</div>
<?php include_once('layouts/footer.php'); ?>
