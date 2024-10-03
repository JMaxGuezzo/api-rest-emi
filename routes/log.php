<?php

require '../controller/usuario_controller.php';



// Rota para adicionar um nick
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);

  // echo json_encode($data);

  if (empty($data['email'])) {
    echo json_encode(['error' => 'O email é obrigatório']);
    exit;
  }
  $opa = Autentica($data['email'], $data['senha']);
  if ($opa = true) {
    echo json_encode('Autenticado');
  } else {
    echo json_encode('Não autenticado');
  }
}
