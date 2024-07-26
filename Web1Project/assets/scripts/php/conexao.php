<?php

$usuario = 'root';
$senha = '';
$database= 'web1';
$host= 'localhost';

$mysqli = new mysqli($host, $usuario,$senha,$database);

if($mysqli->error){
    die("Falha ao conectar ao banco de dados: ". $mysqli->error);
}

