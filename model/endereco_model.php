<?php

require '../service/conexao.php';
function getEndereco(){
    $pdo = new usePDO;
    $conn = $pdo->getInstance();
    $stmt = $conn->query('SELECT * FROM endereco'); 
    $endereco = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $endereco;

}

// function putEndereco(){

//     $stmt = $conn->query('SELECT * FROM endereco'); 
//     $endereco = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     return $endereco;

// }




function insertEndereco($cep, $bairro, $rua, $numero, $id_cidade, $id_pessoa){
    try{
        $conn = new usePDO;
        $cnx = $conn->getInstance();
        $sql = "INSERT INTO `endereco`(
            `cep`,
            `bairro`,
            `rua`,
            `numero`,
            `id_cidade`,
            `id_pessoa`

        ) 
        VALUES (
            \"$cep\",
            \"$bairro\",
            \"$rua\",
            \"$numero\",
            \"$id_cidade\",
            \"$id_pessoa\"
        )";



        $cnx->exec($sql);
        $result = $cnx->lastInsertId();//pega o id
        return $result;
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
        return 'ErroInserirendereco';

        header('location:processa.php?errousuarios');
    }
}

function updateEndereco($id, $cep, $bairro, $rua, $numero, $id_cidade, $id_pessoa){
    try{
        $conn = new usePDO;
        $cnx = $conn->getInstance();
        $sql = "UPDATE `endereco` SET `cep`='$cep', `bairro`='$bairro', `rua`='$rua', `numero`='$numero', `id_cidade`='$id_cidade', `id_pessoa`='$id_pessoa' WHERE `id`=$id";

        $cnx->exec($sql);
        $result = $cnx->lastInsertId();//pega o id
        return $result;
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
        return 'ErroUpdateendereco';

        header('location:processa.php?erroupusuarios');
    }
}

function deleteEndereco($id){
    try{
        $conn = new usePDO;
        $cnx = $conn->getInstance();
        $sql = "DELETE FROM `endereco` WHERE id = $id";

        $cnx->exec($sql);

    }
    catch(Exception $e)
    {
        echo $e->getMessage();
        return 'ErroDeleteendereco';

        header('location:processa.php?erroudeleteusuarios');
    }
}
?>