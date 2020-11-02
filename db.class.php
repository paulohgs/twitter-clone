<?php

class db {

    //host
    private $host = 'localhost';
    //usuario
    private $usuario = 'paulohgs';
    //senha
    private $senha = 'Pa@8167';
    //banco de dados
    private $database = 'twitter_clone';

    public function conecta_mysql(){

        //criar conexao
        $connection = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);
        mysqli_set_charset($connection, 'utf8');

        //verificar erros de conexao

        if(mysqli_connect_errno()){
            echo 'Erro ao se conectar com o BD Mysql'.mysqli_connect_error();

        }
        return $connection;

    }


}
