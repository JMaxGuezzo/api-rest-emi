<?php

require '../controller/usuario_controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && empty($_GET)) {

  if (validaToken(getallheaders()['token'])) {

    try {
      $user = buscarUser();
      header('Content-Type: application/json');
      echo json_encode($user);
    } catch (PDOException $e) {
      echo json_encode(['error' => $e->getMessage()]);
    }
  } else {
    echo json_encode(['mensagem' => 'token invalido']);
    return;
  }
}

// Rota para adicionar um nick
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if (validaToken(getallheaders()['token'])) {

    $data = json_decode(file_get_contents('php://input'), true);
    $email = $data['email'];

    // echo json_encode($data);

    if (empty($data['nick'])) {
      echo json_encode(['error' => 'O nome do nick é obrigatório']);
      exit;
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "O endereço de e-mail '$email' é considerado válido.\n";
      $user = createUser($data);
      echo json_encode($user);
    } else {
      echo "O endereço de e-mail '$email' é considerado inválido.\n";
    }
  } else {
    echo json_encode(['mensagem' => 'token invalido']);
    return;
  }
}

// Rota para fazer update de um nick
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
  if (validaToken(getallheaders()['token'])) {

    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['email'])) {
      echo json_encode(['error' => 'O email do usuário é obrigatório']);
      exit;
    }
    if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
      echo "O endereço de e-mail '" . $data['email'] . "' é considerado válido.\n";

      $user = atualUser($data);
      echo json_encode($user);
    } else {
      echo "O endereço de e-mail '" . $data['email'] . "' é considerado inválido.\n";
    }
  } else {
    echo json_encode(['mensagem' => 'token invalido']);
    return;
  }
}

// Rota para deletar uma tarefa
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  if (validaToken(getallheaders()['token'])) {

    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['id'])) {
      echo json_encode(['error' => 'O ID do nick é obrigatório']);
      exit;
    }

    $user = deletarUser($data['id']);
  } else {
    echo json_encode(['mensagem' => 'token invalido']);
    return;
  }
}
