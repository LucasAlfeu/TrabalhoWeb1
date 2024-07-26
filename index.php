<?php 

    session_start();


 $url = 'localhost';
 $usuario = 'root';
 $senha = '';
 $dataBase = '';
 $link = new mysqli($url, $usuario, $senha, $dataBase);
 $link->set_charset('utf8');

 if($link){
     echo "Conexão Okay";
 } else {
     die('Connect Error ('.mysqli_connect_errno().')'.mysqli_connect_error());
 }


 $nameDataBase = "web1";
 $query_create_schema = "CREATE SCHEMA IF NOT EXISTS $nameDataBase" or die("Error in the consult... ".$link->connect_error);
 $result_create_schema = $link->query($query_create_schema);

 if($link->query($query_create_schema) === TRUE){
    // echo "<p>Criou o Banco de Dados</p>";
 } else {
     //echo "<p>Não criou o banco de dados</p>";
 }

 mysqli_select_db($link, $nameDataBase);

 $query_create_table_resp = "CREATE TABLE IF NOT EXISTS responsavel (
                                         id_Resp int AUTO_INCREMENT PRIMARY KEY,
                                         nome_Resp varchar(45) NOT NULL,
                                         email_Resp varchar(60) NOT NULL,
                                         contato_Resp varchar(15) NOT NULL)"
 or die("Error in the create Responsavel table...".$link->connect_error);
 $result_create_table = $link->query($query_create_table_resp);

 if($link->query($query_create_table_resp) === TRUE){
     //echo "<p>Criou a tabela de Responsavel</p>";
 } else {
    //echo "<p>Não criou a tabela de Responsavel</p>";
 }

 $query_create_table_avatar = "CREATE TABLE IF NOT EXISTS avatar(
                                         id_Avat int AUTO_INCREMENT PRIMARY KEY,
                                         pele_Avat varchar(60) NOT NULL,
                                         rosto_Avat varchar(60) NOT NULL,
                                         cabelo_Avat varchar(60) NOT NULL,
                                         torso_Avat varchar(60) NOT NULL,
                                         pernas_Avat varchar(60) NOT NULL)"
 or die("Error in the create Avatar table...".$link->connect_error);
 $result_create_table_avatar = $link->query($query_create_table_avatar);

 if($link->query($query_create_table_avatar) === TRUE){
     //echo "<p>Criou a tabela de Avatar</p>";
 } else {
     //echo "<p>Não criou a tabela de Avatar</p>";
 }

 $query_create_table_paci = "CREATE TABLE IF NOT EXISTS paciente(
                                                 id_Pac int AUTO_INCREMENT PRIMARY KEY,
                                                 nome_Paci varchar(60) NOT NULL,
                                                 dataNasci_Pac varchar(10) NOT NULL,
                                                 id_Resp int NOT NULL,
                                                 id_Avat int NOT NULL,
                                                 CONSTRAINT fk_responsavel_paciente
                                                 FOREIGN KEY (id_Resp) REFERENCES responsavel(id_Resp),
                                                 CONSTRAINT fk_avatar_paciente
                                                 FOREIGN KEY (id_Avat) REFERENCES avatar(id_Avat)
                                                 )"
 or die("Error in the create Paciente table... ".$link->query($query_create_table_paci));

 if($link->query($query_create_table_paci) === TRUE){
 //echo "<p>Criou a tabela de Paciente</p>";
 } else {
 //echo "<p>Não criou a tabela de Paciente</p>";
 } 

 $query_create_table_form = "CREATE TABLE IF NOT EXISTS formulario(
                                 id_Form int AUTO_INCREMENT PRIMARY KEY,
                                 resp_Form varchar(15) NOT NULL,
                                 id_Pac int NOT NULL,
                                 CONSTRAINT fk_paciente_formulario
                                 FOREIGN KEY (id_Pac) REFERENCES paciente(id_Pac)
                                 ) ENGINE = InnoDB"
 or die("Error in the create Form table... ".$link->query($query_create_table_form));

 if($link->query($query_create_table_form) === TRUE){
     //echo "<p>Criou a tabela de Formulario</p>";
 } else {
     //echo "<p>Não criou a tabela de Formulario</p>";
 }


 $query_create_table_dentista = "CREATE TABLE IF NOT EXISTS dentista(
                                         id_Dent int AUTO_INCREMENT PRIMARY KEY,
                                         nome_Dent varchar(45) NOT NULL,
                                         usuario_Dent varchar(30) NOT NULL,
                                         senha_Dent varchar(16) NOT NULL)"
 or die("Error in the create Dentista table... ".$link->query($query_create_table_dentista));

 if($link->query($query_create_table_dentista) === TRUE){
     //echo "<p>Criou a tabela de Dentista</p>";
 } else {
     //echo "<p>Não criou a tabela de Dentista</p>";
 }   

 $query_create_table_consulta = "CREATE TABLE IF NOT EXISTS consulta(
                                        id_Cons int AUTO_INCREMENT PRIMARY KEY,
                                        procedimenti_Cons varchar(50) NOT NULL,
                                        data_Cons varchar(12) NOT NULL,
                                        id_Form int NOT NULL,
                                        id_Dent int NOT NULL,
                                        id_Pac int NOT NULL,
                                        CONSTRAINT fk_form_consulta
                                        FOREIGN KEY (id_Form) REFERENCES formulario(id_Form),
                                        CONSTRAINT fk_dentista_consulta
                                        FOREIGN KEY (id_Dent) REFERENCES dentista(id_Dent),
                                        CONSTRAINT fk_pacient_consulta
                                        FOREIGN KEY (id_Pac) REFERENCES formulario(id_Pac))"
    or die("Error in the create Dentista table... ".$link->query($query_create_table_consulta));

    if($link->query($query_create_table_consulta) === TRUE){
        //echo "<p>Criou a tabela de Consulta</p>";
    } else {
        //echo "<p>Não criou a tabela de Consulta</p>";
    }

    $userDent = $passwDent = $tentUser = $tentPass = "";
    $usuarioErr = $senhaErr = "";

    function teste_entrada($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST["usuario"])){
            $nomeResErr = "Nome do Responsável Obrigatório";
        } else {
            $userDent = teste_entrada($_POST["usuario"]);
        }
 
        if(empty($_POST["senha"])){
            $emailRespErr = "Email do Responsável Obrigatório";
        } else {
            $passwDent = teste_entrada($_POST["senha"]);
        }

        if(empty($usuarioErr) && empty($emailRespErr)){
            $servidor = "localhost"; // ou o IP do seu servidor MySQL
            $usuario = "root"; // seu usuário MySQL
            $senha = ""; // sua senha MySQL
            $banco = ""; // o nome do seu banco de dados
             
            // Cria uma nova conexão MySQLi
            $conn = new mysqli($servidor, $usuario, $senha, $banco);

            if ($conn->connect_error) {
                die("Conexão falhou: " . $conn->connect_error);
                echo "<script type='javascript'>alert('Erro!');";
                echo "javascript:window.location='../../../cadastroPaciente.php';</script>";
            }
             
            $nameDataBase = "web1";
            mysqli_select_db($conn, $nameDataBase);

            $sql_usuario = "SELECT usuario_Dent, senha_Dent FROM dentista WHERE usuario_Dent='$userDent' AND senha_Dent='$passwDent'";
            $result = $conn->query($sql_usuario);

            
            if ($result->num_rows > 0) {
                // Saída dos dados de cada linha
                while($row = $result->fetch_assoc()) {
                    $tentUser = $row["usuario_Dent"];
                    $tentPass = $row["senha_Dent"];
                }
            } else {
                echo "0 resultados";
            }

            if($userDent == $tentUser && $passwDent == $tentPass){
                $_SESSION["Usuario"] = $userDent;
                $_SESSION["senha"] = $passwDent;
                header("Location: inicio.php");
                exit();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/styles/cadastroPaciente.css">
    <link rel="stylesheet" href="./assets/styles/login.css">
    <title>Login</title>
</head>
<body>
    <header class="header">
        <img class="header__image" src="./assets/images/header.png" alt="">
    </header>

    <main class="principal__login">
        <form class="box__login" method="POST">
            <img src="./assets/images/Odonto_Prime.png" alt="" class="logo">
            <div class="caixa">
                Usuario: <input type="text" name="usuario" class="ipt_usuario">
                Senha: <input type="password" name="senha" class="ipt_usuario">
            </div>
            <div class="divisao">
                <input type="submit" value="Entrar" class="btnForm" >
                <a href="./Web1Project/cadastroDentista.php" class="btnForm" >Cadastrar</a>
            </div>
        </form>
    </main>
</body>
</html>
