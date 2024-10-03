<?php
require '../model/usuario_model.php';


function validaToken($token)
{
  if (!empty($token)) {
    $ytoken = validToken($token);
    if ($ytoken) {
      return TRUE;
    } else {
      return FALSE;
    }
  } else {
    return FALSE;
  }
}

function buscarUser()
{
  $user = getUser();
  return $user;
}

function Autentica($email, $senha)
{
  $user = AutentUser($email);
  print_r($user);

  if (($email == $user['email']) && ($senha == $user['senha'])) {
    return true;
  } else {
    return false;
  }
}

function createUser($data)
{
  $nick = $data['nick'];
  $email = $data['email'];
  $senha = $data['senha'];
  $id_pessoa = $data['id_pessoa'];
  $token = md5(uniqid(rand(), true));

  $user = insertUser($nick, $email, $senha, $id_pessoa, $token);
  return $user;
}
function atualUser($data)
{
  $id = $data['id'];
  $nick = $data['nick'];
  $email = $data['email'];
  $senha = $data['senha'];
  $id_pessoa = $data['id_pessoa'];

  $user = updateUser($id, $nick, $email, $senha, $id_pessoa);
  return $user;
}
function deletarUser($data)
{


  $user = deleteUser($data);
}
