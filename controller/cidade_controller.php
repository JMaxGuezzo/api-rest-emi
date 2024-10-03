<?php
require '../model/cidade_model.php';

function buscarCidade()
{
  $cidade = getcidade();
  return $cidade;
}
function createCidade($data)
{
  $cidade = $data['cidade'];
  $id_estado = $data['id_estado'];

  $cidade = insertCidade($cidade, $id_estado);
  return $cidade;
}
function atualCidade($data)
{
  $id = $data['id'];
  $cidade = $data['cidade'];
  $id_estado = $data['id_estado'];

  $cidade = updateCidade($id, $cidade, $id_estado);
  return $cidade;
}
function deletarCidade($data)
{


  $cidade = deleteCidade($data);
}
