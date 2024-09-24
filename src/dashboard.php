<?php
session_start();
require '../conexao/conexao.php';

if (!isset($_SESSION['professor_id'])) {
    header("Location: index.php");
    exit();
}

// Lógica para exibir notas ou adicionar nova nota
?>

<h1>Painel do Professor</h1>

<a href="adicionar_Nota.php">Adicionar Nota</a>
<a href="registrarAluno.php">Registrar aluno</a>
<a href="sair.php">Sair</a>

<table>
    <tr>
        <th>Aluno</th>
        <th>Disciplina</th>
        <th>Nota</th>
        <th>Data</th>
        <th>Ações</th>
    </tr>
    <?php
    $professor_id = $_SESSION['professor_id'];
    $stmt = $conn->prepare("SELECT * FROM Notas JOIN Alunos ON Notas.aluno_id = Alunos.id WHERE professor_id = ?");
    $stmt->execute([$professor_id]);
    while ($nota = $stmt->fetch()) {
        echo "<tr>
            <td>{$nota['nome']}</td>
            <td>{$nota['disciplina']}</td>
            <td>{$nota['nota']}</td>
            <td>{$nota['data']}</td>
            <td><a href='editarNota.php?id={$nota['id']}'>Editar</a></td>
        </tr>";
    }
    ?>
</table>
