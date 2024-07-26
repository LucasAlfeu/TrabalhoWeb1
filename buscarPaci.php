<?php
$url = 'localhost';
$usuario = 'root';
$senha = '';
$dataBase = '';

$link = new mysqli($url, $usuario, $senha, $dataBase);
$link->set_charset('utf8');

if($link->connect_error) {
    die('Connect Error ('.mysqli_connect_errno().')'.mysqli_connect_error());
}

$nameDataBase = "web1";
mysqli_select_db($link, $nameDataBase);

if (isset($_GET['query']) && !empty($_GET['query'])) {
    $query = $link->real_escape_string($_GET['query']);
    $sql = "SELECT * FROM paciente WHERE nome_Paci LIKE '%$query%'";
    $result = $link->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Data de Nascimento</th>
                    <th>Histórico</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id_Pac']}</td>
                    <td>{$row['nome_Paci']}</td>
                    <td>{$row['dataNasci_Pac']}</td>
                    <td><a href='./historicoPaciente.php'>Link</a></td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "Nenhum resultado encontrado.";
    }
}

$link->close();
?>
