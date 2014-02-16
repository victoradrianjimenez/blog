<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts extends CI_Controller {
  
  function __construct(){
    parent::__construct();
  }
  
	public function index(){
		$this->listar();
	}

	public function ver($id){
		$this->load->model('Post');
    $this->load->model('Comentario');
    $this->load->model('Gestor_posts');
    
    $idUsuario = 1;
    $post = $this->Gestor_posts->dame_post($id, $idUsuario);
    if ($post){
      $comentarios = $post->listar_comentarios();
      $datos_vista = array(
        'seccion_pagina' => 'posts',
        'titulo_pagina' => $post->titulo,
        'post' => $post,
        'comentarios' => $comentarios,
        'mensaje' => $this->session->flashdata('mensaje'),
        'mensaje_tipo' => $this->session->flashdata('mensaje_tipo'),
        'usuario' => $this->ion_auth->user()->row(),
      );
      $this->load->view('post_ver', $datos_vista);
    }
	}
	

	public function listar(){
	  $this->load->model('Post');
	  $this->load->model('Gestor_posts');

	  $idUsuario = 1;
    $lista = $this->Gestor_posts->listar_posts($idUsuario);
    
    $datos_vista = array(
      'seccion_pagina' => 'posts',
      'titulo_pagina' => 'Listado de Posts',
      'posts' => $lista,
      'mensaje' => $this->session->flashdata('mensaje'),
      'mensaje_tipo' => $this->session->flashdata('mensaje_tipo'),
      'usuario' => $this->ion_auth->user()->row(),
    );
		$this->load->view('post_listar', $datos_vista);
	}
	
  
	/*
	 * Parametros POST: $idUsuario, $titulo, $contenido, $activo
	 */
	public function alta(){
    $this->load->model('Post');
    $this->load->model('Gestor_posts');
		$this->load->library('form_validation');
    $idUsuario = 1;
    
    $mensaje = $this->session->flashdata('mensaje');
    $mensaje_tipo = $this->session->flashdata('mensaje_tipo');
    
    //verificar datos
		$this->form_validation->set_rules('titulo', 'Título', 'required|max_length[250]');
		$this->form_validation->set_rules('contenido', 'Contenido', 'required');
		$this->form_validation->set_rules('activo', 'Publicado', 'required');
		
		//si la validacion es true es porque el usuario ya envio el formulario, entonces doy de alta
		if ($this->form_validation->run() == TRUE){
			$mensaje = $this->Gestor_posts->alta_post($idUsuario, $this->input->post('titulo'), $this->input->post('contenido'), $this->input->post('activo'));
      if ($mensaje == TRUE){
        $this->session->set_flashdata('mensaje', 'La operación se realizó con éxito.');
        $this->session->set_flashdata('mensaje_tipo', 'success');
        redirect('posts/listar');
        //termina aqui
      }
      $mensaje_tipo = 'danger';
		}
    //caso contrario, muestro el formulario para que lo llene
    $datos_vista = array(
      'seccion_pagina' => 'posts',
      'titulo_pagina' => 'Nuevo Post',
      'destino' => site_url('posts/alta'),
      'post_data' => $this->input->post(),
      'mensaje' => $mensaje,
      'mensaje_tipo' => $mensaje_tipo,
      'usuario' => $this->ion_auth->user()->row(),
    );
    $this->load->view('post_editar', $datos_vista);
	}


  public function modificar($id){
    $this->load->model('Post');
    $this->load->model('Gestor_posts');
    $this->load->library('form_validation');
    $idUsuario = 1;
    
    $mensaje = $this->session->flashdata('mensaje');
    $mensaje_tipo = $this->session->flashdata('mensaje_tipo');
    
    //verificar datos
    $this->form_validation->set_rules('titulo', 'Título', 'required|max_length[250]');
    $this->form_validation->set_rules('contenido', 'Contenido', 'required');
    $this->form_validation->set_rules('activo', 'Publicado', 'required');
    //obtengo el objeto post
    $post = $this->Gestor_posts->dame_post($id, $idUsuario);
    //si la validacion es true es porque el usuario ya envio el formulario, entonces modifico el post
    if ($this->form_validation->run() == TRUE){
      $post->titulo = $this->input->post('titulo');
      $post->contenido = $this->input->post('contenido');
      $post->activo = $this->input->post('activo');
      $mensaje = $this->Gestor_posts->modificar_post($post);
      if ($mensaje == TRUE){
        $this->session->set_flashdata('mensaje', 'La operación se realizó con éxito.');
        $this->session->set_flashdata('mensaje_tipo', 'success');
        redirect('posts/listar');
        //termina aqui
      }
      $mensaje_tipo = 'danger';
    }
    //caso contrario, muestro el formulario para que lo llene
    $datos_vista = array(
      'seccion_pagina' => 'posts',
      'titulo_pagina' => 'Modificar un post',
      'destino' => site_url('posts/modificar/'.$id),
      'post_data' => (array)$post,
      'mensaje' => $mensaje,
      'mensaje_tipo' => $mensaje_tipo,
      'usuario' => $this->ion_auth->user()->row(),
    );
    $this->load->view('post_editar', $datos_vista);
  }
  

	public function baja($id){
    $this->load->model('Gestor_posts');
    $idUsuario = 1;
    
    $mensaje = $this->Gestor_posts->baja_post($id, $idUsuario);
    if ($mensaje == TRUE){
      $this->session->set_flashdata('mensaje', 'La operación se realizó con éxito.');
      $this->session->set_flashdata('mensaje_tipo', 'success');
    }
    else{
      $this->session->set_flashdata('mensaje', $mensaje);
      $this->session->set_flashdata('mensaje_tipo', 'danger');
    }
    redirect('posts/listar');
	}
	
	public function buscar(){
    $this->load->model('Post');
    $this->load->model('Gestor_posts');
    $texto = $this->input->get('texto');
    $lista = $this->Gestor_posts->buscar_posts($texto);
    $datos_vista = array(
      'seccion_pagina' => 'posts',
      'titulo_pagina' => 'Listado de Posts',
      'posts' => $lista,
      'mensaje' => $this->session->flashdata('mensaje'),
      'mensaje_tipo' => $this->session->flashdata('mensaje_tipo'),
      'usuario' => $this->ion_auth->user()->row(),
    );
    $this->load->view('post_listar', $datos_vista);
	}

}
