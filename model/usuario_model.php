<?php

require_once '../service/conexao.php';
function getUser()
{
  $pdo = new usePDO;
  $conn = $pdo->getInstance();
  $stmt = $conn->query('SELECT * FROM user');
  $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $user;
}

function AutentUser($email)
{
  $pdo = new usePDO;
  $conn = $pdo->getInstance();
  $stmt = $conn->query("SELECT * FROM user WHERE `email`='$email'");
  $user = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
  return $user;
}


// function putUser()
// {
//   $conn = new usePDO;
//   $cnx = $conn->getInstance();
//   $sql = "SELECT * FROM user";
//   $stmt = $cnx->exec($sql);
//   $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
//   return $user;
// }

function insertUser($nick, $email, $senha, $id_pessoa, $token)
{
  try {
    $conn = new usePDO;
    $cnx = $conn->getInstance();
    $sql = "INSERT INTO `user`(
            `nick`,
            `email`,
            `senha`,
            `id_pessoa`,
            `token`
        ) 
        VALUES (
            \"$nick\",
            \"$email\",
            \"$senha\",
            \"$id_pessoa\",
            \"$token\"
        )";



    $cnx->exec($sql);
    $result = $cnx->lastInsertId(); //pega o id
    return $result;
  } catch (Exception $e) {
    echo $e->getMessage();
    return 'ErroInserirUser';
  }
}

function updateUser($id, $nick, $email, $senha, $id_pessoa)
{
  try {
    $conn = new usePDO;
    $cnx = $conn->getInstance();
    $sql = "UPDATE `user` SET `nick`='$nick', `email`='$email', `senha`='$senha', `id_pessoa`='$id_pessoa' WHERE `id`=$id";

    $cnx->exec($sql);
    $result = $cnx->lastInsertId(); //pega o id
    return $result;
  } catch (Exception $e) {
    echo $e->getMessage();
    return 'ErroUpdateUser';
  }
}

function deleteUser($id)
{
  try {
    $conn = new usePDO;
    $cnx = $conn->getInstance();
    $sql = "DELETE FROM `user` WHERE id = $id";

    $cnx->exec($sql);
  } catch (Exception $e) {
    echo $e->getMessage();
    return 'ErroDeleteUser';

  }
}

function validToken($token)
{
  $sql = "";
  try {
    $pdo = new usePDO;
    $conn = $pdo->getInstance();
    $stmt = $conn->query("SELECT * FROM user WHERE `token`='$token'");
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $user;
  } catch (Exception $e) {
    echo $e->getMessage();
    return 'ErrotokenUser';
  }
}
