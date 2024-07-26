<?php 
   $nomeResp = $emailResp = $telResp = "";
   $nomePaci = $nasciPaci = "";
   $cabelo = $rosto = $pele = $torso = $pernas = "";

   function teste_entrada($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST["nome_resp"])){
            $nomeResp = "Nome do Responsável Obrigatório";
        } else {
            $nomeResp = teste_entrada($_POST["nome_resp"]);
            if(!preg_match("/^[a-zA-Z]*$/", $nomeResp)){
                $nomeResp = "Apenas letras e espaços em branco são permitidos";
            }
        }

        if(empty($_POST["email_resp"])){
            $emailResp = "Email do Responsável Obrigatório";
        } else {
            $emailResp = teste_entrada($_POST["email_resp"]);
            if(!filter_var($emailResp, FILTER_VALIDATE_EMAIL)){
                $emailResp = "Email do responsável no formato errado";
            }
        }

        if(empty($_POST["tel_resp"])){
            $telResp = "Telefone do Responsável Obrigatório";
        } else {
            $telResp = teste_entrada($_POST["tel_resp"]);
            if(!preg_match("/^[0-9]*$/", $telResp)){
                $telResp = "Apenas números e espaços em branco são permitidos";
            }
        }

        if(empty($_POST["nome_paci"])){
            $nomePaci = "Nome do Paciente Obrigatório";
        } else {
            $nomePaci = teste_entrada($_POST["nome_paci"]);
            if(!preg_match("/^[a-zA-Z]*$/", $nomePaci)){
                $nomePaci = "Apenas letras e espaços em branco são permitidos";
            }
        }

        if(empty($_POST["nasci_paci"])){
            $nasciPaci = "Data de Nascimento do Paciente Obrigatório";
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
        $troso = "./assets/images/torso/".$torsoAux.".png";
        $pernas = "./assets/images/pernas/".$pernasAux.".png";

        echo "<p> Nome Responsável: $nomeResp";
        echo "<p> Nome Paciente: $nomePaci";

        if (!empty($nomeResp) && !empty($emailResp) && !empty($telResp) && !empty($nomePaci) && !empty($nasciPaci)) {

            
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
            $sql = "INSERT INTO responsavel(nome_Resp, email_Resp, tel_Resp) VALUES('$nomeResp', '$emailResp', '$telResp')";
            $sql_query = $conn->query($sql_code) or die("Falha na execução do código SQL: " . $conn->error);

            if ($conn->query($sql) === TRUE) {
                echo "Novo registro criado com sucesso";
            } else {
                echo "Erro: " . $sql . "<br>" . $conn->error;
            }


            //$query_resp = "INSERT INTO responsavel(nome_Resp, email_Resp, tel_Resp) VALUES(:nome, :email: tel)";
            // $query_resp ="INSERT INTO responsavel(nome_Resp, email_Resp, tel_Resp) VALUES(?,?,?)";
            // $stmt = $link->prepare($query_resp);
            // $stmt->bind_param("sss", $nomeResp, $emailResp, $telResp);

            // if ($stmt->execute()) {
            //     echo "Dados inseridos com sucesso!";
            // } else {
            //     echo "Erro ao inserir dados: " . $stmt->error;
            // }
        }

        // $url = 'localhost';
        // $usuario = 'root';
        // $senha = '';
        // $dataBase = 'web1';
        // $link = new mysqli($url, $usuario, $senha, $dataBase);
        // $link->set_charset('utf8');

        
        
        // //$query_resp = "INSERT INTO responsavel(nome_Resp, email_Resp, tel_Resp) VALUES(:nome, :email: tel)";
        // $query_resp ="INSERT INTO responsavel(nome_Resp, email_Resp, tel_Resp) VALUES(?,?,?)";
        // $stmt = $link->prepare($query_resp);
        // $stmt->bind_param("sss", $nomeResp, $emailResp, $telResp);

        // if ($stmt->execute()) {
        //     echo "Dados inseridos com sucesso!";
        // } else {
        //     echo "Erro ao inserir dados: " . $stmt->error;
        // }
        

        // $query_avatar = "INSERT INTO avatar(pele_Avat, rosto_Avat, cabelo_Avat, torso_Avat, pernas_Avat) VALUES (:pele, :rosto, :cabelo, :torso, :pernas)"
        // or die("Error in the create Responsavel table...".$link->connect_error);
        // $resul_avatar = $link->prepare($query_avatar);
        // $resul_avatar->bind_param(":pele", $pele);
        // $resul_avatar->bind_param(":rosto", $rosto);
        // $resul_avatar->bind_param(":cabelo", $cabelo);
        // $resul_avatar->bind_param(":torso", $torso);
        // $resul_avatar->bind_param(":pernas", $pernas);
        // $resul_avatar->execute();

    }
?>