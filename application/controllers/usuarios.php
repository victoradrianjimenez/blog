<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {
  
  function __construct(){
    parent::__construct();
  }

  //log the user in
  function login(){
    $this->load->library('form_validation');
    $this->load->library('ion_auth');
    $this->ion_auth->set_lang('es');
    //validate form input
    $this->form_validation->set_rules('identity', 'Identity', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
    if ($this->form_validation->run() == true){
      //check to see if the user is logging in and check for "remember me"
      $remember = (bool) $this->input->post('remember');
      if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)){
        //if the login is successful redirect them back to the home page
        $this->session->set_flashdata('mensaje', $this->ion_auth->messages());
        $this->session->set_flashdata('mensaje_tipo', 'success');
        redirect('posts');
      }
      else{
        //if the login was un-successful redirect them back to the login page
        $this->session->set_flashdata('mensaje', $this->ion_auth->errors());
        $this->session->set_flashdata('mensaje_tipo', 'danger');
        redirect('/');
      }
    }
    $datos_vista = array(
      'seccion_pagina' => 'login',
      'titulo_pagina' => 'Iniciar sesión',
      'mensaje' => $this->session->flashdata('mensaje'),
      'mensaje_tipo' => $this->session->flashdata('mensaje_tipo'),
      'usuario' => $this->ion_auth->user()->row(),
    );
    $this->load->view('usuario_login', $datos_vista);
  }

  function logout(){
    $this->ion_auth->set_lang('es');
    $logout = $this->ion_auth->logout();
    //redirect them to the home page
    $this->session->set_flashdata('mensaje', $this->ion_auth->messages());
    $this->session->set_flashdata('mensaje_tipo', 'success');
    redirect('/');
  }

  public function modificar($id=NULL){
    $this->load->model('Post');
    $this->load->model('Gestor_posts');
    $this->load->library('form_validation');
    if ($id==NULL){
      $user = $this->ion_auth->user()->row();
    }
    else{
      $user = $this->ion_auth->user($id)->row();
    }
    $mensaje = $this->session->flashdata('mensaje');
    $mensaje_tipo = $this->session->flashdata('mensaje_tipo');
    $data = array();
    
    //verificar datos
    $this->form_validation->set_rules('first_name', 'Nombre', 'required|max_length[50]|xss_clean');
    $this->form_validation->set_rules('last_name', 'Apellido', 'required|max_length[50]|xss_clean');
    if ($this->input->post('email') != $user->email){
      $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[users.email]');
    }
    //si se introdujo contraseña, actualizarla, sino dejar la que tenia
    if ($this->input->post('password')){
      $this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
      $this->form_validation->set_rules('password_confirm', 'Confirmar contraseña', 'required');
      $data['password'] = $this->input->post('password');
    }
    //si la validacion es true es porque el usuario ya envio el formulario, entonces modifico el post
    if ($this->form_validation->run() == TRUE){
      $data['first_name'] = $this->input->post('first_name');
      $data['last_name'] = $this->input->post('last_name');
      $data['email'] = $this->input->post('email');
      if ($this->ion_auth->update($user->id, $data) == TRUE){
        $this->session->set_flashdata('mensaje', 'La operación se realizó con éxito.');
        $this->session->set_flashdata('mensaje_tipo', 'success');
        redirect('posts');
        //termina aqui
      }
      $mensaje = $this->ion_auth->errors();
      $mensaje_tipo = 'danger';
    }
    //caso contrario, muestro el formulario para que lo llene
    $datos_vista = array(
      'seccion_pagina' => 'users',
      'titulo_pagina' => 'Editar cuenta de usuario',
      'destino' => site_url('usuarios/modificar/'.$user->id),
      'user_data' => $user,
      'mensaje' => $mensaje,
      'mensaje_tipo' => $mensaje_tipo,
      'usuario' => $this->ion_auth->user()->row(),
    );
    $this->load->view('usuario_editar', $datos_vista);
  }
  

}
