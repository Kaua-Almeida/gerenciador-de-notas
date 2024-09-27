<?php
require '../conexao/conexao.php';
session_start();

if (!isset($_SESSION['aluno_id'])) {
    header("Location: loginAluno.php");
    exit();
}

?>
<div class="conteudo">

    <header>
        <h1>Painel de Notas</h1>
        <ul>
            <li><a href="sair.php">Sair</a></li>
        </ul>
    </header>

    <table>
        <tr>
            <th>Aluno</th>
            <th>Disciplina</th>
            <th>Nota</th>
            <th>Data</th>

        </tr>

        <?php
        $aluno_id = $_SESSION['aluno_id'];
        $stmt = $conn->prepare("SELECT * FROM Notas JOIN Alunos ON Notas.aluno_id = alunos.id");
        $stmt->execute();

        while ($nota = $stmt->fetch()) {
            echo
            "<tr>
            <td>{$nota['nome']}</td>
            <td>{$nota['disciplina']}</td>
            <td>{$nota['nota']}</td>
            <td>{$nota['data']}</td>
        </tr>
        ";
        }
        ?>

    </table>
</div>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peinel das Notas</title>
    <link rel="stylesheet" href="../css/Dashboard.css">

</head>

<body>

</body>

</html>