<?php
//variaveis de conexão
$servername = "localhost";// 127.0.0.1 servidor
$username = "root"; //nome do usuario
$password = ""; //senha do usuario
$db_name = "bdlogin"; //nome do banco de dados
$port = "3307"; //porta do MariaDB

$connect = mysqli_connect($servername, $username, $password,$db_name,$port);

if(mysqli_connect_error()){
    echo"Falha na conexão: ".mysqli_connect_error();
}
/*
else{
    echo "Conectado com Sucesso!!!";
}
*/

