<?php
require '../conexao/conexao.php';
session_start();

if (!isset($_SESSION['aluno_id'])) {
    header("Location: loginAluno.php");
    exit();
}


?>

<h1>Painel do aluno</h1>


<a href="sair.php">Sair</a>

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
        echo "<tr>
            <td>{$nota['nome']}</td>
            <td>{$nota['disciplina']}</td>
            <td>{$nota['nota']}</td>
            <td>{$nota['data']}</td>
        </tr>";
    }
    ?>
</table>
