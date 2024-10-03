<?php
require '../controller/endereco_controller.php';
require '../controller/usuario_controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && empty($_GET)) {
  if (validaToken(getallheaders()['token'])) {

    try {
      $endereco = buscarEndereco();
      header('Content-Type: application/json');
      echo json_encode($endereco);
    } catch (PDOException $e) {
      echo json_encode(['error' => $e->getMessage()]);
    }
  } else {
    echo json_encode(['mensagem' => 'token invalido']);
    return;
  }
}

// Rota para adicionar um endereco
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (validaToken(getallheaders()['token'])) {

    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['cep'])) {
      echo json_encode(['error' => 'O nome do endereco é obrigatório']);
      exit;
    }

    $endereco = createEndereco($data);
    $data['id'] = $endereco;
    header('Content-Type: application/json');
    echo json_encode($data);
  } else {
    echo json_encode(['mensagem' => 'token invalido']);
    return;
  }
}

// Rota para fazer update de um endereco
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
  if (validaToken(getallheaders()['token'])) {

    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['id'])) {
      echo json_encode(['error' => 'O ID do endereco é obrigatório']);
      exit;
    }

    $endereco = atualEndereco($data);
    header('Content-Type: application/json');
    echo json_encode($endereco);
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
      echo json_encode(['error' => 'O ID do endereco é obrigatório']);
      exit;
    }

    $endereco = deletarEndereco($data['id']);
    if ($endereco) {
      echo json_encode(['mensagem' => 'Endereco deletado com sucesso']);
    } else {
      echo json_encode(['error' => 'Erro ao deletar endereco']);
    }
  } else {
    echo json_encode(['mensagem' => 'token invalido']);
    return;
  }
}
