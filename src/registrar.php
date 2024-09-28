<?php
require '../conexao/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Hash da senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Inserir no banco de dados
    $stmt = $conn->prepare("INSERT INTO professores (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $email, $senha_hash]);

    echo "Professor registrado com sucesso!";
}
?>

<form method="POST" action="registrar.php">
    Nome: <input type="text" name="nome" required>
    Email: <input type="email" name="email" required>
    Senha: <input type="password" name="senha" required>
    <input type="submit" value="Registrar">
</form>