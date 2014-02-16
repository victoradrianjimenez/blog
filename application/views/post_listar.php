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
    
    <div class="page-header">
      <h2><?php echo $titulo_pagina?></h2>
    </div>

    <table class="table table-condensed table-bordered table-hover table-striped">
      <thead>
        <tr>
          <th class="info">Título</th>
          <th class="info">Activo</th>
          <th class="info">Fecha</th>
          <th class="info" style="text-align:right;">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($posts as $i => $post):?>
          <tr>
            <td class="titulo"><?php echo $post->titulo?></td>
            <td class="activo"><?php echo $post->activo?></td>
            <td class="fecha"><?php echo $post->dameFecha()?></td>
            <td align="right">
              <div class="btn-group">
                <a class="btn btn-default mostrar" href="<?php echo site_url('posts/ver/'.$post->idPost)?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                <a class="btn btn-default modificar" href="<?php echo site_url('posts/modificar/'.$post->idPost)?>"><span class="glyphicon glyphicon-edit"></span></a>
                <a class="btn btn-default eliminar" href="<?php echo site_url('posts/baja/'.$post->idPost)?>"><span class="glyphicon glyphicon-trash"></span></a>
              </div>
            </td>
          </tr>
        <?php endforeach?>
      </tbody>
    </table>
    
    <div class="btn-toolbar">
      <div class="btn-group">
        <a class="btn btn-default" href="<?php echo site_url('posts/alta')?>">Nuevo post</a>
      </div>
    </div>

  </div>
  <div id="push"></div>
</div>

<!-- footer -->
<?php include 'templates/footer.php'?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Confirmar eliminación del Post</h4>
      </div>
      <div class="modal-body">
        ¿Realmente desea eliminar el post titulado "<span class="titulo_post"></span>"?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <a type="button" class="btn btn-primary" href="#">Aceptar</a>
      </div>
    </div>
  </div>
</div>

<?php include 'templates/includes_foot.php'?>

<script>
  $('a.eliminar').click(function(){
    $('#myModal').find('a.btn.btn-primary').attr('href', $(this).attr('href')); //le aviso a la ventana modal a donde dirigirse en caso de aceptar
    $('#myModal').find('span.titulo_post').html($(this).parentsUntil('tr').siblings('td.titulo').html()); //le aviso a la ventana modal como se titula el post
    $('#myModal').modal(); //mostrar modal
    return false; //retornar falso para que no se active el link.
  });
</script>

</body>
</html>