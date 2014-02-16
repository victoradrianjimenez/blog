<!DOCTYPE html>
<html lang="es">
<head>
  <?php include 'templates/includes_head.php'?>
  <title><?php echo $titulo_pagina?></title>
</head>
<body>
<div id="wrapper">
  
  <!-- header -->
  <?php include 'templates/nav.php'?>  
  
  <!-- contenido -->
  <div class="container">
    
    <div class="jumbotron">
      <h1>Bienvenid@ a mi Post!</h1>
      <p>Este es un ejemplo de un sitio desarrollado con CodeIgniter y Twitter Boostrap.</p>
      <p><a class="btn btn-primary btn-lg" role="button" href="<?php echo site_url('posts')?>">Lista de Posts</a></p>
    </div>

  </div>
  <div id="push"></div>
</div>

<!-- footer -->
<?php include 'templates/footer.php'?>

<?php include 'templates/includes_foot.php'?>
</body>
</html>