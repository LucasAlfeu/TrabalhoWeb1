<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/styles/cadastroPaciente.css">
    <link rel="stylesheet" href="./assets/styles/cadastroConsulta.css">
    <title>Cadastro Consulta</title>
</head>
<body>
    <header class="header">
        <img class="header__image" src="./assets/images/header.png" alt="">
    </header>
    <main class="principal">
        <a href="inicio.php" class="principal__volta">Voltar</a>

        <h1 class="principal__title">Cadastro Consulta</h1>
        <form action="" method="GET">
            Identificação do Paciente: <input type="text" class="form__input" name="idPaciente">
            <input type="submit" value="Buscar" class="btnBuscar">
        </form>

        <?php
        include './assets/scripts/php/conexao.php';

        $idPaci = '';
        if(isset($_GET['idPaciente'])) {
            $id = intval($_GET['idPaciente']);
            $idPaci = $id;
            $sql_code = "SELECT pele_Avat, rosto_Avat, cabelo_Avat, torso_Avat, pernas_Avat FROM avatar WHERE id_Avat = ?";
            $stmt = $mysqli->prepare($sql_code);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            $idDoPaciente = $mysqli->insert_id;

            if ($result->num_rows > 0) {
                echo '<div class="form__avatar">';
                while($row = $result->fetch_assoc()) {
                    echo '<img class="cabelo" src="'.$row["cabelo_Avat"].'" alt="Cabelo">';
                    echo '<img class="rosto" src="'.$row["rosto_Avat"].'" alt="Rosto">';
                    echo '<img class="pele" src="'.$row["pele_Avat"].'" alt="Pele">';
                    echo '<img class="torso" src="'.$row["torso_Avat"].'" alt="Torso">';
                    echo '<img class="pernas" src="'.$row["pernas_Avat"].'" alt="Pernas">';
                }
                echo '</div>';
            } else {
                echo "Nenhum avatar encontrado.";
            }
        }
        ?>

        <form action="" id="formConsulta" method="POST">
            Procedimento: <input type="text" name="procedimento">
            <div class="separar"></div>
            Numero do dentista: <input type="text" name="nroDentista">
            <div class="separar">
                <input type="submit" value="Cadastrar" class="btnBuscar cadastrar">
            </div>
        </form>

        <form action="" method="post">
            <label>
                <input type="radio" name="emotion" value="Feliz"> Feliz
            </label>
            <label>
                <input type="radio" name="emotion" value="Aliviado"> Aliviado
            </label>
            <label>
                <input type="radio" name="emotion" value="Dor"> Dor
            </label>
            <label>
                <input type="radio" name="emotion" value="Medo"> Medo
            </label>
            <label>
                <input type="radio" name="emotion" value="Cansaço"> Cansaço
            </label>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $procedimento = $_POST["procedimento"] ?? '';
            $nroDent = $_POST["nroDentista"] ?? '';
            $idPaci = intval($_GET['idPaciente'] ?? 0);
            $data = date("Y-m-d"); // Formato de data correto para MySQL

            // Verifica se os campos estão preenchidos
            if (!empty($procedimento) && !empty($nroDent) && !empty($idPaci)) {

                // Verifica se o paciente existe
                $sql_check_pac = "SELECT id_Pac FROM paciente WHERE id_Pac = ?";
                $stmt_check = $mysqli->prepare($sql_check_pac);
                $stmt_check->bind_param("i", $idPaci);
                $stmt_check->execute();
                $result_check = $stmt_check->get_result();

                if ($result_check->num_rows > 0) {
                    // Insere a consulta
                    $sql_consult = "INSERT INTO consulta (procedimenti_Cons, data_Cons, id_Dent, id_Pac) VALUES (?, ?, ?, ?)";
                    $stmt = $mysqli->prepare($sql_consult);
                    $stmt->bind_param("ssii", $procedimento, $data, $nroDent, $idPaci);

                    if ($stmt->execute()) {
                        echo "Consulta cadastrada com sucesso.";
                    } else {
                        echo "Erro ao cadastrar consulta: " . $stmt->error;
                    }
                } else {
                    echo "Paciente não encontrado.";
                }
            } else {
                echo "Preencha todos os campos.";
            }
        }
        ?>
    </main>
</body>
</html>