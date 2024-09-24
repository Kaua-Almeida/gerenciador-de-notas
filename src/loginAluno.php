<?php
session_start();
require '../conexao/conexao.php'; // Arquivo para conectar ao banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta ao banco de dados
    $stmt = $conn->prepare("SELECT * FROM Alunos WHERE email = ?");
    $stmt->execute([$email]);
    $aluno = $stmt->fetch();

    // Verificação da senha
    if ($aluno && password_verify($senha, $aluno['senha'])) {
        $_SESSION['aluno_id'] = $aluno['id'];
        header("Location: dashboardAluno.php");
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
    <title>Login do Aluno</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <form method="POST">
    <h1>Entre como Aluno</h1>
    Email: <input type="email" name="email" required>
    Senha: <input type="password" name="senha" required>
    <input type="submit" value="Login">
    <a href="./index.php">Professor acessa aqui!</a>
</form>  
</body>
</html>

