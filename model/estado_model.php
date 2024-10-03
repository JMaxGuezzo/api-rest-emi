<?php

require '../service/conexao.php';

function getEstado()
{
  $pdo = new usePDO;
  $conn = $pdo->getInstance();
  $stmt = $conn->query('SELECT * FROM estado');
  $estado = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $estado;
}

function insertEstado($estado, $sigla_estado)
{
  try {
    $conn = new usePDO;
    $cnx = $conn->getInstance();
    $sql = "INSERT INTO `estado`( `estado`, `sigla_estado`)  VALUES ( \"$estado\",\"$sigla_estado\")";
    $cnx->exec($sql);
    $result = $cnx->lastInsertId(); //pega o id
    return $result;
  } catch (Exception $e) {
    echo $e->getMessage();
    return 'ErroInserirestado';
  }
}

function updateEstado($id, $estado, $sigla_estado)
{
  try {
    $conn = new usePDO;
    $cnx = $conn->getInstance();
    $sql = "UPDATE `estado` SET `estado`='$estado', `sigla_estado`='$sigla_estado' WHERE `id`=$id";
    $cnx->exec($sql);

    $sql = "SELECT * FROM `estado` WHERE `id` = $id";
    $consult = $cnx->query($sql);
    $result = $consult->fetchAll(PDO::FETCH_ASSOC)[0];
    return $result;
  } catch (Exception $e) {
    echo $e->getMessage();
    return 'ErroUpdateestado';
  }
}

function deleteEstado($id)
{
  try {
    $conn = new usePDO;
    $cnx = $conn->getInstance();
    $sql = "DELETE FROM `estado` WHERE id = $id";

    $estado = $cnx->exec($sql);
    return $estado;
  } catch (Exception $e) {
    echo $e->getMessage();
    return 'ErroDeleteestado';
  }
}
