<?php
session_start();
require './conexao/conexao.php'; // Arquivo para conectar ao banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta ao banco de dados
    $stmt = $conn->prepare("SELECT * FROM Professores WHERE email = ?");
    $stmt->execute([$email]);
    $professor = $stmt->fetch();
 
    // Verificação da senha
    if ($professor && password_verify($senha, $professor['senha'])) {
        $_SESSION['professor_id'] = $professor['id'];
        header("Location: src/dashboard.php");
        exit();
    } else {
        echo "Email ou senha inválidos!";
       
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <form method="POST">
    <h1>entre como professor</h1>
    Email: <input type="email" name="email" required>
    Senha: <input type="password" name="senha" required>
    <input type="submit" value="Login">
    <a href="src/loginAluno.php">aluno acessa aqui!</a>
</form>  
</body>
</html>

