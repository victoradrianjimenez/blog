<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends CI_Model{
	var $idPost;
	var $idUsuario;
	var $titulo;
  var $contenido;
  var $fecha;
  var $activo;
  
  function __construct(){
    parent::__construct();
  }
  
  function dameFecha(){
    return strftime("%d/%m/%Y %l:%M %p", strtotime($this->fecha));
  }
  
  //devuelve un array de objetos Comentario
  function listar_comentarios(){
    $query = $this->db->query("call listar_comentarios($this->idPost)");
    $data = $query->result('Comentario');
    liberar_resultado_consulta($query);
    return $data;
  }

  //devuelve true o un mensaje de error
  public function alta_comentario($idUsuario, $contenido){
    $idPost = $this->db->escape((int)$this->idPost);
    $idUsuario = $this->db->escape((int)$idUsuario);
    $contenido = $this->db->escape($contenido);
    $query = $this->db->query("call alta_comentario($idPost, $idUsuario, $contenido)");
    $data = $query->row_array();
    liberar_resultado_consulta($query);
    if ($data['mensaje'] != ''){
      return $data['mensaje'];
    }
    return true;
  }
  
  //devuelve true o un mensaje de error
  public function baja_comentario($id){
    $id= $this->db->escape((int)$id);
    $idPost= $this->db->escape((int)$this->idPost);
    $query = $this->db->query("call baja_comentario($id, $idPost)");
    $data = $query->row_array();
    liberar_resultado_consulta($query);
    if ($data['mensaje'] != ''){
      return $data['mensaje'];
    }
    return true;
  }
}
