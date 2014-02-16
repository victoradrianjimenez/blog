<?php
function liberar_resultado_consulta($query)
{
  if (is_object($query->result_id))
  {
    mysqli_free_result($query->result_id);
    $query->result_id = FALSE;
    //las lineas siguientes son para multi query
    do {
      if ($r = mysqli_store_result($query->conn_id)){
        mysqli_free_result($r);
      }
    }while (mysqli_next_result($query->conn_id));
  }
}
?>