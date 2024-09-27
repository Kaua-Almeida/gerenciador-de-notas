<?php
require '../conexao/conexao.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

  
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

   
    $stmt = $conn->prepare("INSERT INTO Alunos (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $email, $senha_hash]);

    echo "Aluno registrado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registrar Aluno</title>
        <link rel="stylesheet" href="../css/RegistrarAluno.css">

    </head>
    <body>
        <img class="senai"src="../img/SenaiLogo.png" alt="">
    
        <form method="POST" action="registrarAluno.php">
        <h1>Registro de alunos</h1>
        Nome: <input type="text" name="nome" required>
        Email: <input type="email" name="email" required>
        Senha: <input type="password" name="senha" required>
        <input type="submit" value="Registrar">
    </form>
    
</body>
</html>