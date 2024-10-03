<?php
require '../controller/cidade_controller.php';
require '../controller/usuario_controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && empty($_GET)) {
  if (validaToken(getallheaders()['token'])) {
    try {
      $cidade = buscarCidade();
      header('Content-Type: application/json');
      echo json_encode($cidade);
    } catch (PDOException $e) {
      echo json_encode(['error' => $e->getMessage()]);
    }
  } else {
    echo json_encode(['mensagem' => 'token invalido']);
    return;
  }
}

// Rota para adicionar uma cidade
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (validaToken(getallheaders()['token'])) {
    $data = json_decode(file_get_contents('php://input'), true);
    if (empty($data['cidade'])) {
      echo json_encode(['error' => 'O nome do cidade é obrigatório']);
      exit;
    }

    $cidade = createCidade($data);
    $data['id'] = $cidade;
    header('Content-Type: application/json');
    echo json_encode($data);
  } else {
    echo json_encode(['mensagem' => 'token invalido']);
    return;
  }
}

// Rota para fazer update de um cidade
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
  if (validaToken(getallheaders()['token'])) {

    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['id'])) {
      echo json_encode(['error' => 'O ID do cidade é obrigatório']);
      exit;
    }

    $cidade = atualCidade($data);
    header('Content-Type: application/json');
    echo json_encode($cidade);
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
      echo json_encode(['error' => 'O ID do cidade é obrigatório']);
      exit;
    }

    $cidade = deletarCidade($data['id']);
    if($cidade) {
      echo json_encode(['mensagem' => 'Cidade deletada com sucesso']);
    } else {
      echo json_encode(['mensagem' => 'Erro ao deletar cidade']);
    }
  } else {
    echo json_encode(['mensagem' => 'token invalido']);
    return;
  }
}
