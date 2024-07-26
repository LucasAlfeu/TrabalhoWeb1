<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/styles/cadastroPaciente.css">
    <title>Histórico Paciente</title>
</head>
<body>
    <header class="header">
        <img class="header__image" src="./assets/images/header.png" alt="">
    </header>
    <main class="principal">
        <a href="javascript:history.back()" class="principal__volta">Voltar</a>
        <?php
        $url = 'localhost';
        $usuario = 'root';
        $senha = '';
        $dataBase = 'web1';

        $link = new mysqli($url, $usuario, $senha, $dataBase);
        $link->set_charset('utf8');

        if($link->connect_error) {
            die('Connect Error ('.mysqli_connect_errno().')'.mysqli_connect_error());
        }

        if (isset($_GET['id_Pac'])) {
            $id_Pac = $link->real_escape_string($_GET['id_Pac']);
            $sql = "SELECT nome_Paci FROM paciente WHERE id_Pac = '$id_Pac'";
            $result = $link->query($sql);

            if ($result->num_rows > 0) {
                $paciente = $result->fetch_assoc();
                echo "<h1 class='principal__title'>Histórico de {$paciente['nome_Paci']}</h1>";

                $sql_consultas = "SELECT * FROM consulta WHERE id_Pac = '$id_Pac'";
                $result_consultas = $link->query($sql_consultas);

                if ($result_consultas->num_rows > 0) {
                    echo "<section class='historico'>
                            <table>
                                <tr>
                                    <th>ID Consulta</th>
                                    <th>Data</th>
                                    <th>Procedimento realizado</th>
                                </tr>";
                    while($row_consulta = $result_consultas->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row_consulta['id_Cons']}</td>
                                <td>{$row_consulta['data_Cons']}</td>
                                <td>{$row_consulta['procedimenti_Cons']}</td>
                              </tr>";
                    }
                    echo "</table>
                        </section>";
                } else {
                    echo "<p>Nenhuma consulta encontrada para este paciente.</p>";
                }
            } else {
                echo "<p>Paciente não encontrado.</p>";
            }
        } else {
            echo "<p>ID do paciente não fornecido.</p>";
        }

        $link->close();
        ?>
    </main>
</body>
</html>
