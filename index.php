<?php
session_start();
require './conexao/conexao.php'; // Arquivo para conectar ao banco de dados
$error = "";

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
        $error = "Email ou senha inválidos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Professor</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <form method="POST">
        <img class="senai" src="img/SenaiLogo.png" alt="Senai">

        <h2>Área do Professor 👨‍💻</h2>
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <input class="button" type="submit" value="Login">

        <div class="esqueceuSenha">
            <a href="src/loginAluno.php">Entrar na área dos alunos!</a>
        </div>
        <?php if (isset($error)): ?>
            <p class="error"> <?php echo $error ?></p>
        <?php endif ?>
    </form>
</body>

</html>