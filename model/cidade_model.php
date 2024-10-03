<?php

require '../service/conexao.php';
function getCidade()
{
  $pdo = new usePDO;
  $conn = $pdo->getInstance();
  $stmt = $conn->query('SELECT * FROM cidade');
  $cidade = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $cidade;
}

// function putCidade(){

//     $stmt = $conn->query('SELECT * FROM cidade'); 
//     $idade = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     return $cidade;

// }




function insertCidade($cidade, $id_estado)
{
  try {
    $conn = new usePDO;
    $cnx = $conn->getInstance();
    $sql = "INSERT INTO `cidade`(
            `cidade`,
            `id_estado`
        ) 
        VALUES (
            \"$cidade\",
            \"$id_estado\"
        )";



    $cnx->exec($sql);
    $result = $cnx->lastInsertId(); //pega o id
    return $result;
  } catch (Exception $e) {
    echo $e->getMessage();
    return 'ErroInserircidade';

    header('location:processa.php?errousuarios');
  }
}

function updateCidade($id, $cidade, $id_estado)
{
  try {
    $conn = new usePDO;
    $cnx = $conn->getInstance();
    $sql = "UPDATE `cidade` SET `cidade`='$cidade', `id_estado`='$id_estado' WHERE `id`=$id";

    $cnx->exec($sql);
    $result = $cnx->lastInsertId(); //pega o id
    return $result;
  } catch (Exception $e) {
    echo $e->getMessage();
    return 'ErroUpdatecidade';

    header('location:processa.php?erroupusuarios');
  }
}

function deleteCidade($id)
{
  try {
    $conn = new usePDO;
    $cnx = $conn->getInstance();
    $sql = "DELETE FROM `cidade` WHERE id = $id";

    $cnx->exec($sql);
  } catch (Exception $e) {
    echo $e->getMessage();
    return 'ErroDeletecidade';

    header('location:processa.php?erroudeleteusuarios');
  }
}
