<?php
session_start();
require '../conexao/conexao.php';

if (!isset($_SESSION['professor_id'])) {
    header("Location: index.php");
    exit();
}

// Lógica para exibir notas ou adicionar nova nota
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/Dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../script/dashboard.js" defer></script>
</head>

<body>
<div class="conteudo">
    <header>
        <h1>Notas dos Alunos</h1>
        <ul class = "desktop">
            <li><a href="adicionar_Nota.php">Adicionar Nota</a></li>
            <li><a href="registrarAluno.php">Registrar aluno</a></li>
            <li><a href="sair.php">Sair</a></li>
        </ul>
         <button class= "menu">&#9776;</button>
        <ul class = "mobile">
            <li><a href="adicionar_Nota.php">Adicionar Nota</a></li>
            <li><a href="registrarAluno.php">Registrar aluno</a></li>
            <li><a href="sair.php">Sair</a></li>
        </ul>
   
    </header>


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

            <td><div  class='icone' >
            <a href='editarNota.php?id={$nota['id']}'>  
            <i class='fa-solid fa-pen'></i>
             Editar</a>
            </div> 
            </td>
        </tr>";
        }
        ?>
    </table>
</div>

</body>

</html>