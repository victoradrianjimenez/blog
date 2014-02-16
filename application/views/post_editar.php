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
    
    <h3><?php echo $titulo_pagina?></h3>

  	<form role="form" action="<?php echo $destino?>" method="post">
      <div class="form-group">
        <label for="titulo">Título</label>
        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ingresar el título del post" value="<?php echo $post_data['titulo']?>">
      </div>
      <div class="form-group">
        <label for="contenido">Contenido</label>
        <textarea id="contenido" name="contenido" class="form-control" rows="10"><?php echo $post_data['contenido']?></textarea>
      </div>
      <div class="form-group">
        <label for="activo">Publicar post?</label>
        <select id="activo" name="activo" class="form-control">
          <option value="Si" <?php echo ($post_data['activo']=='Si')?'selected':''?>>Sí</option>
          <option value="No" <?php echo ($post_data['activo']=='No')?'selected':''?>>No</option>
        </select>
      </div>
      <a class="btn btn-default" href="<?php echo site_url('posts/listar')?>" >Volver</a>
      <button type="submit" name="submit" class="btn btn-default">Enviar</button>
    </form>
  </div>
  <div id="push"></div>
</div>

<!-- footer -->
<?php include 'templates/footer.php'?>

<?php include 'templates/includes_foot.php'?>
</body>
</html>