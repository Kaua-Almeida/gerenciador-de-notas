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

<form method="POST" action="registrarAluno.php">
    Nome: <input type="text" name="nome" required>
    Email: <input type="email" name="email" required>
    Senha: <input type="password" name="senha" required>
    <input type="submit" value="Registrar">
</form>
