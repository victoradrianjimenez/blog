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
    <article>
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h2 class="panel-title"><?php echo $post->titulo?></h2>
        </div>
        <div class="panel-body">
            <span><?php echo $post->contenido?></span>
            Fecha de publicación: <?php echo $post->dameFecha()?>
        </div>
        <div class="panel-footer">

            <div class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title">Comentarios</h2>
                </div>
                <div class="panel-body">
                  <?php if(count($comentarios) > 0):?>
                    <?php foreach ($comentarios as $comentario):?>
                      <div class="media">
                        <div class="btn-group" style="float:right">
                          <a class="btn btn-default eliminar" href="<?php echo site_url('comentarios/baja/'.$post->idPost.'/'.$comentario->idComentario)?>"><span class="glyphicon glyphicon-trash"></span></a>
                        </div> 
                        <a class="pull-left" href="#">
                          <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCI+PHJlY3Qgd2lkdGg9IjY0IiBoZWlnaHQ9IjY0IiBmaWxsPSIjZWVlIi8+PHRleHQgdGV4dC1hbmNob3I9Im1pZGRsZSIgeD0iMzIiIHk9IjMyIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEycHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9zdmc+" style="width: 64px; height: 64px;" class="media-object" data-src="holder.js/64x64" alt="64x64">
                        </a>
                        <div class="media-body">
                          <h4 class="media-heading"><?php echo $comentario->dameFecha()?></h4>
                          <?php echo $comentario->contenido?>
                        </div>
                      </div>
                    <?php endforeach ?>
                  <?php else:?>
                    <span>No se registraron comentarios. Sé el primero!.</span>
                  <?php endif?>
              </div>
              <div class="panel-footer">
                  <h5>Dejanos tu comentario...</h5>
                  <form role="form" action="<?php echo site_url('comentarios/alta')?>" method="post">
                    <input type="hidden" name="idPost" value="<?php echo $post->idPost?>" />
                    <div class="form-group">
                      <textarea class="form-control" id="contenido" name="contenido" cols="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-default">Comentar</button>
                  </form>
              </div>
            </div>

        </div>
      </div>
    </article>
    
  </div>
  <div id="push"></div>
</div>

<!-- footer -->
<?php include 'templates/footer.php'?>

<?php include 'templates/includes_foot.php'?>
</body>
</html>