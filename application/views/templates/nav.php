<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Cambiar navegación</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo site_url()?>">Mi Blog</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="<?php echo ($seccion_pagina == 'posts')?'active':''?>"><a href="<?php echo site_url('posts')?>">Posts</a></li>
      </ul>
      <form id="buscar" class="navbar-form navbar-left" role="search" action="<?php echo site_url('posts/buscar')?>" method="get">
        <div class="input-group">
          <input type="text" class="form-control" name="texto" placeholder="Título del post">
          <span class="input-group-btn">
            <input class="btn btn-default" type="submit" value="Buscar"/>
          </span>
        </div>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <?php if(!(isset($usuario) && is_object($usuario))): ?>
          <li class="<?php echo ($seccion_pagina == 'login')?'active':''?>"><a href="<?php echo site_url('usuarios/login')?>">Login</a></li>
        <?php else: ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $usuario->username?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo site_url('usuarios/modificar')?>">Editar cuenta</a></li>
              <li><a href="<?php echo site_url('usuarios/logout')?>">Cerrar sesión</a></li>
            </ul>
          </li>
        <?php endif?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->

  <!-- mensajes -->
  <?php if(isset($mensaje) && $mensaje!=FALSE && $mensaje!=''):?>
  <div class="alert alert-<?php echo $mensaje_tipo?> alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong><?php echo $mensaje?></strong>
  </div>
  <?php endif?>
</nav>

