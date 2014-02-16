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
      <form role="form" action="<?php echo site_url('usuarios/login')?>" method="post">
        <div class="form-group">
          <label for="identity">Email:</label>
          <input type="email" class="form-control" id="identity" name="identity" placeholder="Dirección de correo electrónico">
        </div>
        <div class="form-group">
          <label for="password">Contraseña:</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox" name="remember"> Recordarme
          </label>
        </div>
        <button type="submit" class="btn btn-default">Iniciar sesión</button>
      </form>
  </div>
  <div id="push"></div>
</div>

<!-- footer -->
<?php include 'templates/footer.php'?>

<?php include 'templates/includes_foot.php'?>

</body>
</html>