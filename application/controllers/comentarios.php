<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comentarios extends CI_Controller {
    
  function __construct(){
    parent::__construct();
  }
  
  /*
   * Parametros POST: $idPost, $contenido
   */
  public function alta(){
    $this->load->model('Comentario');
    $this->load->model('Post');
    $this->load->model('Gestor_posts');
    $this->load->library('form_validation');
    $idUsuario = 1;

    //verificar datos
    $this->form_validation->set_rules('idPost', 'Identificador de post', 'required');
    $this->form_validation->set_rules('contenido', 'Contenido', 'required|max_length[200]');
    //si la validacion es true es porque el usuario ya envio el formulario, entonces doy de alta
    if ($this->form_validation->run() == TRUE){
      $this->Post->idPost = (int)$this->input->post('idPost');
      $mensaje = $this->Post->alta_comentario($idUsuario, $this->input->post('contenido'));
      if ($mensaje == TRUE){
        $this->session->set_flashdata('mensaje', 'La operación se realizó con éxito.');
        $this->session->set_flashdata('mensaje_tipo', 'success');
      }
      else{
        $this->session->set_flashdata('mensaje', $mensaje);
        $this->session->set_flashdata('mensaje_tipo', 'danger');
      }echo '3';
    }
    redirect('posts/ver/'.$this->input->post('idPost'));
  }

  public function baja($idPost, $idComentario){
    $this->load->model('Comentario');
    $this->load->model('Post');
    $this->Post->idPost = $idPost;
    $mensaje = $this->Post->baja_comentario($idComentario);
    if ($mensaje == TRUE){
      $this->session->set_flashdata('mensaje', 'La operación se realizó con éxito.');
      $this->session->set_flashdata('mensaje_tipo', 'success');
    }
    else{
      $this->session->set_flashdata('mensaje', $mensaje);
      $this->session->set_flashdata('mensaje_tipo', 'danger');
    }
    redirect('posts/ver/'.$idPost);
  }

}
