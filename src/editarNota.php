<?php
session_start();
require '../conexao/conexao.php';

if (!isset($_SESSION['professor_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nota = $_POST['nota'];

    $stmt = $conn->prepare("UPDATE notas SET nota = ? WHERE id = ?");
    $stmt->execute([$nota, $id]);

    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM notas WHERE aluno_id = ?");
$stmt->execute([$id]);
$nota = $stmt->fetch();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/EditarNota.css">
</head>

<body>
    <div class="conteudo">
        <img class="senai" src="../img/SenaiLogo.png" alt="">
        <form method="POST" action="editarNota.php">
            <input type="hidden" name="id" value="<?php echo $nota['id']; ?>">
            Nota: <input type="number" step="0.01" name="nota" value="<?php echo $nota['nota']; ?>" required>
            <div class="button">
                <button type="submit">Enviar</button>
            </div>
        </form>
    </div>

</body>

</html>