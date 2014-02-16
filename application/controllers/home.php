<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
  
  function __construct(){
    parent::__construct();
  }
  
	public function index(){
	  $this->ion_auth->user();
    $datos_vista = array(
      'seccion_pagina' => 'home',
      'titulo_pagina' => 'Bienvenid@ a mi Blog',
      'mensaje' => $this->session->flashdata('mensaje'),
      'mensaje_tipo' => $this->session->flashdata('mensaje_tipo'),
      'usuario' => $this->ion_auth->user()->row(),
    );
    $this->load->view('home', $datos_vista);
	}
}
