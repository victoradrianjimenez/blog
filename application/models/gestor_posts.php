<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gestor_posts extends CI_Model{

	//devuelve true o un mensaje de error
	public function alta_post($idUsuario, $titulo, $contenido, $activo){
    $idUsuario = $this->db->escape((int)$idUsuario);
    $titulo= $this->db->escape($titulo);
    $contenido = $this->db->escape($contenido);
    $activo = $this->db->escape($activo);
		$query = $this->db->query("call alta_post($idUsuario, $titulo, $contenido, $activo)");
		$data = $query->row_array();
    liberar_resultado_consulta($query);
    if ($data['mensaje'] != ''){
      return $data['mensaje'];
    }
    return true;
	}
  
  //devuelve un array de objetos Post
  public function listar_posts($idUsuario, $pagina, $items_por_pagina){
    $pagina = $this->db->escape((int)$pagina);$pagina = $this->db->escape((int)$pagina);
    $items_por_pagina = $this->db->escape((int)$items_por_pagina);
    $idUsuario = $this->db->escape((int)$idUsuario);
    $query = $this->db->query("call listar_posts($idUsuario, $pagina, $items_por_pagina)");
    $data = $query->result('Post');
    liberar_resultado_consulta($query);
    return $data;
  }

  //devuelve un array de objetos Post
  public function cantidad_posts($idUsuario){
    $idUsuario = $this->db->escape((int)$idUsuario);
    $query = $this->db->query("call cantidad_posts($idUsuario)");
    $data = $query->row_array();
    liberar_resultado_consulta($query);
    return $data['cantidad'];
  }
    
  //devuelve un objeto Post o false en caso de error
  public function dame_post($id, $idUsuario){
    $id = $this->db->escape((int)$id);
    $idUsuario = $this->db->escape((int)$idUsuario);
    $query = $this->db->query("call dame_post($id, $idUsuario)");
    $data = $query->result('Post');
    liberar_resultado_consulta($query);
    if (count($data) > 0){
      $post = $data[0];
      $post->idPost = (int)$id;
      $post->idUsuario = (int)$idUsuario;
      return $post;
    }
    return false;
  }
  
  //devuelve true o un mensaje de error
  public function modificar_post($post){
    $post->idPost = $this->db->escape((int)$post->idPost);
    $post->idUsuario = $this->db->escape((int)$post->idUsuario);
    $post->titulo = $this->db->escape($post->titulo);
    $post->contenido = $this->db->escape($post->contenido);
    $post->activo = $this->db->escape($post->activo);
    $query = $this->db->query("call modificar_post($post->idPost, $post->idUsuario, $post->titulo, $post->contenido, $post->activo)");
    $data = $query->row_array();
    liberar_resultado_consulta($query);
    if ($data['mensaje'] != ''){
      return $data['mensaje'];
    }
    return true;
  }
  
  //devuelve true o un mensaje de error
  public function baja_post($id, $idUsuario){
    $id= $this->db->escape((int)$id);
    $idUsuario = $this->db->escape((int)$idUsuario);
    $query = $this->db->query("call baja_post($id, $idUsuario)");
    $data = $query->row_array();
    liberar_resultado_consulta($query);
    if ($data['mensaje'] != ''){
      return $data['mensaje'];
    }
    return true;
  }
  
  //devuelve un array de objetos Post
  public function buscar_posts($texto){
    $texto= $this->db->escape($texto);
    $query = $this->db->query("call buscar_posts($texto)");
    $data = $query->result('Post');
    liberar_resultado_consulta($query);
    return $data;
  }

}
