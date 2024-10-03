<?php

class usePDO
{

  //Algumas variáveis com dados sobre o Banco. 
  private $servername = '${{RAILWAY_PRIVATE_DOMAIN}}';
  private $username = "root";
  private $password = '${{MYSQL_ROOT_PASSWORD}}';
  private $dbname = "railway";
  private $instance; // instância de conexão, usada no Singleton

  // método que retorna a instância de conexão
  function getInstance()
  {
    if (empty($instance)) {
      $instance = $this->connection();
    }
    return $instance;
  }

  //método que cria a instância de conexão. 
  private function connection()
  {
    try {
      $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password); //Criando um objeto PDO
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //atribuindo modo de erro do PDO.
      return $conn;
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage() . "<br>";
      if (strpos($e->getMessage(), "Unknown database 'tdah'")) {
        echo "Conexão nula, criando o banco pela primeira vez" . "<br>";
        $conn = $this->createDB();
        return $conn;
      } else
        die("Connection failed: " . $e->getMessage() . "<br>");
    }
  }

  //Métodos do CRUD
  function createDB()
  {
    $sql = "CREATE DATABASE IF NOT EXISTS $this->dbname";
    try {
      $cnx = new PDO("mysql:host=$this->servername", $this->username, $this->password);
      $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $cnx->exec($sql);
      return $cnx;
    } catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }

  //------------------------------>CRIACAO DAS TABELA<------------------------------//

  //--------------->CRIAR TABELA E INSERIR USARIO<---------------//
  function createTablePessoa()
  {
    try {
      $cnx = $this->getInstance();
      $sql = "CREATE TABLE IF NOT EXISTS pessoa (
					id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
					nome VARCHAR(150) NOT NULL,
					idade VARCHAR(100) NOT NULL,
					rg INT UNIQUE NOT NULL,
					cpf VARCHAR(15) UNIQUE NOT NULL,
					orgao_emissor VARCHAR(10) NOT NULL,
					data_nasc VARCHAR(15) NOT NULL,
					sexo VARCHAR(100),
					tele VARCHAR(50)
				)";

      $cnx->exec($sql);
    } catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }

  function createTableUser()
  {
    try {
      $cnx = $this->getInstance();
      $sql = "CREATE TABLE IF NOT EXISTS user (
					id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
					nick VARCHAR(150) UNIQUE NOT NULL,
					email VARCHAR(150) UNIQUE NOT NULL,
					senha TEXT NOT NULL,
					id_pessoa INT UNSIGNED NOT NULL,
					CONSTRAINT fk_tabela_id_pessoa FOREIGN KEY (id_pessoa) REFERENCES pessoa (id)
						ON DELETE CASCADE
						ON UPDATE CASCADE
				)";

      $cnx->exec($sql);
    } catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }

  function createTableEstado()
  {
    try {
      $cnx = $this->getInstance();
      $sql = "CREATE TABLE IF NOT EXISTS estado (
                    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    estado VARCHAR(120) NOT NULL,
                    sigla_estado VARCHAR(120) NOT NULL
                )";

      $cnx->exec($sql);
    } catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }
  function createTableCidade()
  {
    try {
      $cnx = $this->getInstance();
      $sql = "CREATE TABLE IF NOT EXISTS cidade (
                    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    cidade VARCHAR(100) NOT NULL,
                    id_estado INT UNSIGNED NOT NULL,
                    CONSTRAINT fk_id_ponte_end FOREIGN KEY (id_estado) REFERENCES estado(id)
                        ON DELETE CASCADE
                        ON UPDATE CASCADE
                )";

      $cnx->exec($sql);
    } catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }
  function createTableEndereco()
  {
    try {
      $cnx = $this->getInstance();
      $sql = "CREATE TABLE IF NOT EXISTS endereco (
                    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    cep VARCHAR(20) NOT NULL,
                    bairro VARCHAR(80) NOT NULL,
                    rua VARCHAR(100) NOT NULL,
                    numero VARCHAR(10) NOT NULL,
                    id_cidade INT UNSIGNED NOT NULL,
                    id_pessoa INT UNSIGNED UNIQUE NOT NULL,
                    CONSTRAINT fk_id_ponte_cidade FOREIGN KEY (id_cidade) REFERENCES cidade(id)
                        ON DELETE CASCADE
                        ON UPDATE CASCADE,
						CONSTRAINT fk_id_ponte_pessoa FOREIGN KEY (id_pessoa) REFERENCES pessoa(id)
                        ON DELETE CASCADE
                        ON UPDATE CASCADE
                )";

      $cnx->exec($sql);
    } catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }
}
