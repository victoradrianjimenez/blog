<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comentario extends CI_Model{
	var $idComentario;
	var $idPost;
	var $idUsuario;
  var $contenido;
  var $fecha;
  
  function __construct(){
    parent::__construct();
  }
  
  function dameFecha(){
    return strftime("%d/%m/%Y %l:%M %p", strtotime($this->fecha));
  }
}
