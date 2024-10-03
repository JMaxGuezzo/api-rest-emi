<?php
require '../controller/pessoa_controller.php';
require '../controller/usuario_controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && empty($_GET)) {
  if (validaToken(getallheaders()['token'])) {

    try {
      $pessoa = buscarPessoa();
      header('Content-Type: application/json');
      echo json_encode($pessoa);
    } catch (PDOException $e) {
      echo json_encode(['error' => $e->getMessage()]);
    }
  } else {
    echo json_encode(['mensagem' => 'token invalido']);
    return;
  }
}

// Rota para adicionar um pessoa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (validaToken(getallheaders()['token'])) {

    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['nome'])) {
      echo json_encode(['error' => 'O nome do pessoa é obrigatório']);
      exit;
    }

    $pessoa = createPessoa($data);
    $data['id'] = $pessoa;
    header('Content-Type: application/json');
    echo json_encode($data);
  } else {
    echo json_encode(['mensagem' => 'token invalido']);
    return;
  }

  // echo json_encode($pessoa);
}

// Rota para fazer update de um pessoa
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
  if (validaToken(getallheaders()['token'])) {

    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['id'])) {
      echo json_encode(['error' => 'O ID do pessoa é obrigatório']);
      exit;
    }

    $pessoa = atualPessoa($data);
    header('Content-Type: application/json');
    echo json_encode($pessoa);
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
      echo json_encode(['error' => 'O ID do pessoa é obrigatório']);
      exit;
    }

    $pessoa = deletarPessoa($data['id']);
    if ($pessoa) {
      echo json_encode(['mensagem' => 'Pessoa deletada com sucesso']);
    } else {
      echo json_encode(['error' => 'Erro ao deletar pessoa']);
    }
  } else {
    echo json_encode(['mensagem' => 'token invalido']);
    return;
  }
}
