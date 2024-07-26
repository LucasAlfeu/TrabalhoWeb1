

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

        <form action="" id="formConsulta">
            Procedimento: <input type="text">
            <div class="separar">
                <input type="submit" value="Cadastrar" class="btnBuscar cadastrar">
            </div>
        </form>

        <?php
        include './assets/scripts/php/conexao.php';
        if(isset($_GET['idPaciente'])) {
            $id = intval($_GET['idPaciente']);

            $sql_code = "SELECT pele_Avat, rosto_Avat, cabelo_Avat, torso_Avat, pernas_Avat FROM avatar WHERE id_Avat = $id";
            $result = $mysqli->query($sql_code);

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
                echo "Erro: " . $sql_code . "<br>" . $mysqli->error;
            }
        }
        ?>
    </main>
</body>
</html>