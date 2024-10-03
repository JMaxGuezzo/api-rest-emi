<?php
require '../model/pessoa_model.php';

function buscarPessoa()
{
  $pessoa = getPessoa();
  return $pessoa;
}
function createPessoa($data)
{
  $nome = $data['nome'];
  $idade = $data['idade'];
  $rg = $data['rg'];
  $cpf = $data['cpf'];
  $orgao_emissor = $data['orgao_emissor'];
  $data_nasc = $data['data_nasc'];
  $sexo = $data['sexo'];
  $tele = $data['tele'];

  $pessoa = insertPessoa($nome, $idade, $rg, $cpf, $orgao_emissor, $data_nasc, $sexo, $tele);
  return $pessoa;
}
function atualPessoa($data)
{
  $id = $data['id'];
  $nome = $data['nome'];
  $idade = $data['idade'];
  $rg = $data['rg'];
  $cpf = $data['cpf'];
  $orgao_emissor = $data['orgao_emissor'];
  $data_nasc = $data['data_nasc'];
  $sexo = $data['sexo'];
  $tele = $data['tele'];

  $pessoa = updatePessoa($id, $nome, $idade, $rg, $cpf, $orgao_emissor, $data_nasc, $sexo, $tele);
  return $pessoa;
}
function deletarPessoa($data)
{


  $pessoa = deletePessoa($data);
}
