<?php
require '../model/estado_model.php';

function buscarEstado()
{
  $estado = getEstado();
  return $estado;
}
function createEstado($data)
{
  $estado = $data['estado'];
  $sigla_estado = $data['sigla_estado'];

  $estado = insertEstado($estado, $sigla_estado);
  return $estado;
}
function atualEstado($data)
{
  $id = $data['id'];
  $estado = $data['estado'];
  $sigla_estado = $data['sigla_estado'];

  $estado = updateEstado($id, $estado, $sigla_estado);
  return $estado;
}
function deletarEstado($data)
{
    $estado = deleteEstado($data);
    return $estado;
}
