<?php
require '../controller/estado_controller.php';
require '../controller/usuario_controller.php';

// Rota para buscar todos os estados
if ($_SERVER['REQUEST_METHOD'] === 'GET' && empty($_GET)) {
  if (validaToken(getallheaders()['token'])) {
    try {
      $estado = buscarEstado();
      header('Content-Type: application/json');
      echo json_encode($estado);
    } catch (PDOException $e) {
      echo json_encode(['error' => $e->getMessage()]);
    }
  } else {
    echo json_encode(['mensagem' => 'token invalido']);
    return;
  }
}

// Rota para adicionar um estado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (validaToken(getallheaders()['token'])) {

    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['estado'])) {
      echo json_encode(['error' => 'O nome do estado é obrigatório']);
      exit;
    }

    $estado = createEstado($data);
    $data['id'] = $estado;
    header('Content-Type: application/json');
    echo json_encode($data);
  } else {
    echo json_encode(['mensagem' => 'token invalido']);
    return;
  }
}

// Rota para fazer update de um estado
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
  if (validaToken(getallheaders()['token'])) {

    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['id'])) {
      echo json_encode(['error' => 'O ID do estado é obrigatório']);
      exit;
    }
    $estado = atualEstado($data);
    header('Content-Type: application/json');
    echo json_encode($estado);
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
      echo json_encode(['error' => 'O ID do estado é obrigatório']);
      exit;
    }

    $estado = deletarEstado($data['id']);
    if($estado){
      http_response_code(204);
      header('Content-Type: application/json');
    }else{
      http_response_code(404);
    }
  } else {
    echo json_encode(['mensagem' => 'token invalido']);
    return;
  }
}
