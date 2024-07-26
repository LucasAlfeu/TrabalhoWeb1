<?php
include './assets/scripts/php/conexao.php';

if(isset($_POST['Procedimento']) || isset($_POST['NroPaciente'])) {

    if(strlen($_POST['Procedimento']) == 0){
        echo "Preencha o campo de Procedimento";
    } 
    else if(strlen($_POST['NroPaciente']) == 0) {
        echo "Preencha o campo de número do paciente";
    }
    else {

        $proc = $mysqli->real_escape_string($_POST['Procedimento']);
        $nrop = $mysqli->real_escape_string($_POST['NroPaciente']);

        $sql_code = "INSERT INTO paciente(id_Pac,nome_Paci,dataNasci_Pac,id_Resp,id_Avat) VALUES(4,'André','24/07/2017',3,2)";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        if ($mysqli->query($sql_code) === TRUE) {
            echo "Novo registro criado com sucesso";
        } else {
            echo "Erro: " . $sql_code . "<br>" . $mysqli->error;
        }
    }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Consulta</title>
    <link rel="stylesheet" href="./assets/styles/cadastroConsulta.css">
</head>
<body>
    <header class="header">
        <img class="header__image" src="./assets/images/header.png" alt="">
    </header>   

    <main class="principal">
        <a class="voltar" href="" class="voltar_principal">Voltar</a>
        <h1>Cadastrar Consulta</h1>
        <form action="" method="POST" class="formulario_principal">
            <p>
                <label>Procedimento: </label>
                <input type="text" name="Procedimento" style="width: 570px; height: 20px;">
            </p>
            <p>
                <label>Número do Paciente: </label>
                <input type="text" name="NroPaciente" style="width: 570px; height: 20px;">
            </p>
            


        

        <div class="imagens">
            <div>
                <img class="foto" src="">
            </div>
            <div>
                <img class="foto" src="">
            </div>
            <div>
                <img class="foto" src="">
            </div>
            <div>
                <img class="foto" src="">
            </div>
            <div>
                <img class="foto" src="">
            </div>
        </div>


        <p class="btn_cadastrar_container">
            <button type="submit" class="btn_cadastrar">Cadastrar</button>
        </p>
        </form>

    </main>

    <footer class="footer">
        <img class="footer__img" src="./assets/images/footer.png" alt="">
    </footer>



    
</body>
</html>