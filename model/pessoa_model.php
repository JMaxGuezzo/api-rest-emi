<?php

require '../service/conexao.php';
function getPessoa()
{
  $pdo = new usePDO;
  $conn = $pdo->getInstance();
  $stmt = $conn->query('SELECT * FROM pessoa');
  $pessoa = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $pessoa;
}

// function putPessoa()
// {

//   $stmt = $conn->query('SELECT * FROM pessoa');
//   $pessoa = $stmt->fetchAll(PDO::FETCH_ASSOC);
//   return $pessoa;
// }




function insertPessoa($nome, $idade, $rg, $cpf, $orgao_emissor, $data_nasc, $sexo, $tele)
{
  try {
    $conn = new usePDO;
    $cnx = $conn->getInstance();
    $sql = "INSERT INTO `pessoa`(
            `nome`,
            `idade`,
            `rg`,
            `cpf`,
            `orgao_emissor`,
            `data_nasc`,
            `sexo`,
            `tele`
        ) 
        VALUES (
            \"$nome\",
            \"$idade\",
            \"$rg\",
            \"$cpf\",
            \"$orgao_emissor\",
            \"$data_nasc\",
            \"$sexo\",
            \"$tele\"
        )";



    $cnx->exec($sql);
    $result = $cnx->lastInsertId(); //pega o id
    return $result;
  } catch (Exception $e) {
    echo  $e->getMessage();
    return 'ErroInserirpessoa';

    header('location:processa.php?errousuarios');
  }
}

function updatePessoa($id, $nome, $idade, $rg, $cpf, $orgao_emissor, $data_nasc, $sexo, $tele)
{
  try {
    $conn = new usePDO;
    $cnx = $conn->getInstance();
    $sql = "UPDATE `pessoa` SET `nome`='$nome', `idade`='$idade', `rg`='$rg', `cpf`='$cpf', `orgao_emissor`='$orgao_emissor', `data_nasc`='$data_nasc', `sexo`='$sexo', `tele`='$tele' WHERE `id`=$id";

    $cnx->exec($sql);
    $result = $cnx->lastInsertId(); //pega o id
    return $result;
  } catch (Exception $e) {
    echo  $e->getMessage();
    return 'ErroUpdatepessoa';

    header('location:processa.php?erroupusuarios');
  }
}

function deletePessoa($id)
{
  try {
    $conn = new usePDO;
    $cnx = $conn->getInstance();
    $sql = "DELETE FROM `pessoa` WHERE id = $id";

    $cnx->exec($sql);
  } catch (Exception $e) {
    echo  $e->getMessage();
    return 'ErroDeletepessoa';

    header('location:processa.php?erroudeletepessoa');
  }
}
