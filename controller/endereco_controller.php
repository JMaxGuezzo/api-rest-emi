<?php
require '../model/endereco_model.php';

// function buscarCEP(){

//     $cep = document.getElementById('cep').value;
//     var xhr = new XMLHttpRequest();
//     xhr.open('GET', 'https://viacep.com.br/ws/' + cep + '/json/', true);
//     console.log(xhr);

//     xhr.onload = function(){
//         if(xhr.status >= 200 && xhr.status < 400){
//             var data = JSON.parse(xhr.responseText);
//             if(data.erro){
//                 alert('CEP não encontrado!');
//             } else{
//                 document.getElementById('logradouro').value = data.logradouro;
//                 document.getElementById('bairro').value = data.bairro;
//                 document.getElementById('cidade').value = data.localidade;
//                 document.getElementById('estado').value = data.uf;
//                 document.getElementById('apijson').value=JSON.stringify(data,null,2);
//             }
//         }else{
//             alert('Erro ao tentar buscar o CEP!');
//         }
//     };
//     xhr.send();
// }

//     $url = "https://viacep.com.br/ws/$cep/json/";

// // Inicializa uma nova sessão cURL
// $ch = curl_init();

// // Configura as opções da requisição
// curl_setopt($ch, CURLOPT_URL, $url);           // Define a URL
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retorna o resultado como uma string
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Não verifica o certificado SSL (opcional)

// // Executa a requisição
// $response = curl_exec($ch);

// // Verifica se houve algum erro
// if (curl_errno($ch)) {
//     echo 'Erro cURL: ' . curl_error($ch);
// } else {
//     // Decodifica a resposta JSON
//     $data = json_decode($response, true);

//     // Verifica se a resposta contém erro
//     if (isset($data['erro'])) {
//         echo "CEP não encontrado.";
//     } else {
//         // Exibe os dados do endereço
//         echo "Logradouro: " . $data['logradouro'] . "<br>";
//         echo "Bairro: " . $data['bairro'] . "<br>";
//         echo "Cidade: " . $data['localidade'] . "<br>";
//         echo "Estado: " . $data['uf'] . "<br>";
//     }
// }

// // Fecha a sessão cURL
// curl_close($ch);

function buscarEndereco()
{
  $endereco = getEndereco();
  return $endereco;
}
function createEndereco($data)
{
  $cep = $data['cep'];
  $bairro = $data['bairro'];
  $rua = $data['rua'];
  $numero = $data['numero'];
  $id_cidade = $data['id_cidade'];
  $id_pessoa = $data['id_pessoa'];

  $endereco = insertEndereco($cep, $bairro, $rua, $numero, $id_cidade, $id_pessoa);
  return $endereco;
}
function atualEndereco($data)
{
  $id = $data['id'];
  $cep = $data['cep'];
  $bairro = $data['bairro'];
  $rua = $data['rua'];
  $numero = $data['numero'];
  $id_cidade = $data['id_cidade'];
  $id_pessoa = $data['id_pessoa'];

  $endereco = updateEndereco($id, $cep, $bairro, $rua, $numero, $id_cidade, $id_pessoa);
  return $endereco;
}
function deletarEndereco($data)
{


  $endereco = deleteEndereco($data);
}
