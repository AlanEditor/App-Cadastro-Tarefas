<?php

    class Conexao{

        private $host = 'localhost';
        private $dbname = 'php-com-pdo';
        private $user = 'root';
        private $pass = '';

        function conectar(){

            try {

                $conexao = new PDO("mysql:host=$this->host;dbname=$this->dbname", "$this->user", "$this->pass");
                return $conexao;
                
            }
            
            catch (PDOException $e) {
                
                echo '<p>'.$e->getMessage().'</p>';

            }

        }
    }


?>