<?php
session_start();
require '../conexao/conexao.php'; // Arquivo para conectar ao banco de dados
$error = "";

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
        $error = "Email ou senha inválidos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login do Aluno</title>
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>
 <form method="POST">
    <img class="senai"src="../img/SenaiLogo.png" alt="">

    <h2>Área do Aluno 😎</h2>
    <input type="email" name="email" placeholder="E-mail"  required>
    <input type="password" name="senha" placeholder="Senha" required>
    <input class="button" type="submit" value="Login">
    <div class="esqueceuSenha">
    <a href="../index.php">Acessar a área dos professores!</a>
    </div>    
    <?php if(isset($error)): ?>
        <p> <?php echo $error ?></p>
        <?php endif ?>
</form>  

</form>   
</body>
</html>

