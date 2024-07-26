<?php
include './assets/scripts/php/conexao.php';

if(isset($_POST['nome']) || isset($_POST['identificacao']) || isset($_POST['usuario']) || isset($_POST['senha']) || isset($_POST['confirmasenha'])) {

    if(strlen($_POST['nome']) == 0){
        echo "Preencha o campo de Procedimento";
    } 
    else if(strlen($_POST['identificacao']) == 0) {
        echo "Preencha o campo de número do paciente";
    }
    

    else {

        $nome = $mysqli->real_escape_string($_POST['nome']);
        $identificacao = $mysqli->real_escape_string($_POST['identificacao']);
        $usuario = $mysqli->real_escape_string($_POST['usuario']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "INSERT INTO dentista(nome,identificacao,usuario,senha) VALUES('$nome','$identificacao','$usuario','$senha')";
        

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
    <title>Cadastro Dentista</title>
    <link rel="stylesheet" href="./assets/styles/cadastroDentista.css">
</head>
<body>

    <header class="header">
            <img class="header__image" src="./assets/images/header.png" alt="">
    </header>

    <main class="principal">
        
        <a class="voltar" href="" class="voltar_principal">Voltar</a>
        <h1>Cadastrar</h1>

        <div class="principal_container">
            <div>
                <form action="" method="POST">
                    <p>
                        <label>Nome:</label>
                        <input type="text" name="nome" style="width: 570px; height: 20px;">
                        
                    </p>
                    <p>
                        <label>Identificação:</label>
                        <input type="text" name="identificacao" style="width: 570px; height: 20px;">
                        
                    </p>
                    <p>
                        <label>Usuário:</label>
                        <input type="text" name="usuario" style="width: 570px; height: 20px;">
                        
                    </p>
                    <p>
                        <label>Senha:</label>
                        <input type="text" name="senha" style="width: 570px; height: 20px;">
                        
                    </p>
                    <p>
                        <label>Confirma Senha:</label>
                        <input type="text" name="confirmasenha" style="width: 570px; height: 20px;">
                        
                    </p>
                    <p class="btn_cadastrar_container">
                        <button type="submit" class="btn_cadastrar">Cadastrar</button>
                    </p>
                    
                    
                </form>
            </div>
            <div>
                <img class="consultorio" src="./assets/images/consultorioDentista.png" alt="">
            </div>
        </div>
    </main>

    <footer class="footer">
        <img class="footer__img" src="./assets/images/footer.png" alt="">
    </footer>
</body>

</html>