<?php 
    $nomeResp = $emailResp = $telResp = "";
    $nomeResErr = $emailRespErr = $telRespErr = "";
    $nomePaci = $nasciPaci = "";
    $nomePaciErr = $nasciPaciErr = "";
    $cabelo = $rosto = $pele = $torso = $pernas = "";
 
    function teste_entrada($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
     }
 
     if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST["nome_resp"])){
            $nomeResErr = "Nome do Responsável Obrigatório";
        } else {
            $nomeResp = teste_entrada($_POST["nome_resp"]);
            if(!preg_match("/^[a-zA-Z]*$/", $nomeResp)){
                $nomeResErr = "Apenas letras e espaços em branco são permitidos";
            }
        }
 
        if(empty($_POST["email_resp"])){
            $emailRespErr = "Email do Responsável Obrigatório";
        } else {
            $emailResp = teste_entrada($_POST["email_resp"]);
            if(!filter_var($emailResp, FILTER_VALIDATE_EMAIL)){
                $emailRespErr = "Email do responsável no formato errado";
            }
        }
 
        if(empty($_POST["tel_resp"])){
            $telRespErr = "Telefone do Responsável Obrigatório";
        } else {
            $telResp = teste_entrada($_POST["tel_resp"]);
            if(!preg_match("/^[0-9]*$/", $telResp)){
                $telRespErr = "Apenas números e espaços em branco são permitidos";
            }
        }
 
        if(empty($_POST["nome_paci"])){
            $nomePaciErr = "Nome do Paciente Obrigatório";
        } else {
            $nomePaci = teste_entrada($_POST["nome_paci"]);
            if(!preg_match("/^[a-zA-Z]*$/", $nomePaci)){
                $nomePaciErr = "Apenas letras e espaços em branco são permitidos";
            }
        }
 
        if(empty($_POST["nasci_paci"])){
            $nasciPaciErr = "Data de Nascimento do Paciente Obrigatório";
        } else {
            $nasciPaci = teste_entrada($_POST["nasci_paci"]);
        } 
 
        $cabeloAux = $_POST["cabelo_lego"];
        $rostoAux = $_POST["rosto_lego"];
        $peleAux = $_POST["pele_lego"];
        $torsoAux = $_POST["tronco_lego"];
        $pernasAux = $_POST["pernas_lego"];
 
        $cabelo = "./assets/images/cabelo/".$cabeloAux.".png";
        $rosto = "./assets/images/rosto/".$rostoAux.".png";
        $pele = "./assets/images/pele/".$peleAux.".png";
        $torso = "./assets/images/torso/".$torsoAux.".png";
        $pernas = "./assets/images/pernas/".$pernasAux.".png";
 
        if (empty($nomeResErr) && empty($emailRespErr) && empty($telRespErr) && empty($nomePaciErr) && empty($nasciPaciErr)) {             
            $servidor = "localhost"; // ou o IP do seu servidor MySQL
            $usuario = "root"; // seu usuário MySQL
            $senha = ""; // sua senha MySQL
            $banco = ""; // o nome do seu banco de dados
             
            // Cria uma nova conexão MySQLi
            $conn = new mysqli($servidor, $usuario, $senha, $banco);
             
            // Verifica se a conexão foi bem-sucedida
            if ($conn->connect_error) {
                die("Conexão falhou: " . $conn->connect_error);
                echo "<script type='javascript'>alert('Erro!');";
                echo "javascript:window.location='../../../cadastroPaciente.php';</script>";
            }
             
            $nameDataBase = "web1";
            mysqli_select_db($conn, $nameDataBase);

            //Adicionar um responsãvel
            $sql = "INSERT INTO responsavel(nome_Resp, email_Resp, contato_Resp) VALUES('$nomeResp', '$emailResp', '$telResp')";
            if ($conn->query($sql) === TRUE) {
                echo "Novo registro criado com sucesso";
            } else {
                echo "Erro: " . $sql . "<br>" . $conn->error;
            }

            $idResp = $conn->insert_id;

            //Adicionar um avatar
            $sql_avatar = "INSERT INTO avatar(pele_Avat, rosto_Avat, cabelo_Avat, torso_Avat, pernas_Avat) VALUES('$pele', '$rosto', '$cabelo', '$torso', '$pernas')";
            if ($conn->query($sql_avatar) === TRUE) {
                echo "Novo registro criado com sucesso";
            } else {
                echo "Erro: " . $sql_avatar . "<br>" . $conn->error;
            }

            $idAvat = $conn->insert_id;

            //Cadastro De Paciente
            $sql_paciente = "INSERT INTO paciente(nome_Paci, dataNasci_Pac, id_Resp, id_Avat) VALUES('$nomePaci', '$nasciPaci', '$idResp', '$idAvat')";
            if ($conn->query($sql_paciente) === TRUE) {
                echo "Novo registro criado com sucesso";
            } else {
                echo "Erro: " . $sql_paciente . "<br>" . $conn->error;
            }
        }
    }
 ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/styles/cadastroPaciente.css">
    <title>Cadastro de Paciente</title>
</head>
<body>
    <header class="header">
        <img class="header__image" src="./assets/images/header.png" alt="">
    </header>
    <main class="principal">
        <a href="" class="princial__volta">Voltar</a>
        <h1 class="principal__title">Cadastro de Paciente</h1>
        <form action="cadastroPaciente.php" class="principal__formulario" method="POST">
            <h2 class="formulario__titulo">Responsável</h2>
            <div class="form__box">
                Nome: <input type="text" class="form__input"  name="nome_resp">
                Email: <input type="text" class="form__input" name="email_resp">
                Telefone: <input type="text" class="form__input" name="tel_resp">
            </div>

            <h2 class="formulario__titulo">Criança</h2>
            <div class="form__box">
                Nome: <input type="text" class="form__input" name="nome_paci">
                Data Nascimento: <input type="text" class="form__input" name="nasci_paci">
            </div>
            <br>
            <h2 class="formulario__titulo">Avatar</h2>
            <section class="form__avatar">
                <div class="form__avatar--corpo">
                    <img src="./assets/images/cabelo/1.png" alt="" class="cabelo" id="cabelo_image">
                    <img src="./assets/images/rosto/1.png" alt="" class="rosto" id="rosto_image">
                    <img src="./assets/images/pele/1.png" alt="" class="pele" id="pele_image">
                    <img src="./assets/images/torso/1.png" alt="" class="tronco" id="tronco_image">
                    <img src="./assets/images/pernas/1.png" alt="" class="pernas" id="pernas_image">
                </div>
                <div class="form__avatar--controlers">
                    <div class="avatar__box">
                        Cabelo: 
                        <input type="button" value="←" class="btn" onclick="diminuirCabelo(document.getElementById('cabelo_lego'), document.getElementById('cabelo_image'))">
                        <input class="avatar__input" type="text" id="cabelo_lego" value="1" name="cabelo_lego">
                        <input type="button" value="→" class="btn" onclick="aumentarCabelo(document.getElementById('cabelo_lego'), document.getElementById('cabelo_image'))"">
                    </div>
                    <div class="avatar__box">
                        Rosto: 
                        <input type="button" value="←" class="btn" onclick="diminuirRosto(document.getElementById('rosto_lego'), document.getElementById('rosto_image'))">
                        <input class="avatar__input" type="text" id="rosto_lego" value="1" name="rosto_lego">
                        <input type="button" value="→" class="btn" onclick="aumentarRosto(document.getElementById('rosto_lego'), document.getElementById('rosto_image'))">
                    </div>
                    <div class="avatar__box">
                        Pele: 
                        <input type="button" value="←" class="btn" onclick="diminuirPele(document.getElementById('pele_lego'), document.getElementById('pele_image'))">
                        <input class="avatar__input" type="text" id="pele_lego" value="1" name="pele_lego">
                        <input type="button" value="→" class="btn" onclick="aumentarPele(document.getElementById('pele_lego'), document.getElementById('pele_image'))">
                    </div>
                    <div class="avatar__box">
                        Tronco: 
                        <input type="button" value="←" class="btn" onclick="diminuirTorso(document.getElementById('tronco_lego'), document.getElementById('tronco_image'))">
                        <input class="avatar__input" type="text" id="tronco_lego" value="1"name="tronco_lego">
                        <input type="button" value="→" class="btn" onclick="aumentarTorso(document.getElementById('tronco_lego'), document.getElementById('tronco_image'))">
                    </div>
                    <div class="avatar__box">
                        Pernas: 
                        <input type="button" value="←" class="btn" onclick="diminuirPerna(document.getElementById('pernas_lego'), document.getElementById('pernas_image'))">
                        <input class="avatar__input" type="text" id="pernas_lego" value="1" name="pernas_lego">
                        <input type="button" value="→" class="btn" onclick="aumentarPerna(document.getElementById('pernas_lego'), document.getElementById('pernas_image'))">
                    </div>
                </div>
            </section>
            <input type="submit" value="Cadastrar" class="form__btnCadastrar" onclick="">
        </form>
        <div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </div>
    </main>

    <footer class="footer">
        <img class="footer__img" src="./assets/images/footer.png" alt="">
    </footer>
    <script src="./assets/scripts/javascript/moldaAvatar.js"></script>
</body>
</html>