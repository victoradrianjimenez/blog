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
    
    <form role="form" action="<?php echo site_url('usuarios/modificar/'.$user_data->id)?>" method="post">
      <div class="form-group">
        <label for="first_name">Nombre:</label>
        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nombre" value="<?php echo $user_data->first_name?>">
      </div>
      <div class="form-group">
        <label for="last_name">Apellido:</label>
        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Apellido" value="<?php echo $user_data->last_name?>">
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" value="<?php echo $user_data->email?>">
      </div>
      <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
      </div>
      <div class="form-group">
        <label for="password_confirm">Confirmar contraseña:</label>
        <input type="password" class="form-control" id="password" name="password_confirm" placeholder="Contraseña">
      </div>
      <?php $msj = validation_errors();
        if ($msj!='') echo '<div class="alert alert-danger">'.$msj.'</div>';
      ?>
      <button type="submit" class="btn btn-default">Submit</button>
    </form>

  </div>
  <div id="push"></div>
</div>

<!-- footer -->
<?php include 'templates/footer.php'?>

<?php include 'templates/includes_foot.php'?>
</body>
</html>