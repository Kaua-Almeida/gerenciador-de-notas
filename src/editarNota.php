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

    $stmt = $conn->prepare("UPDATE Notas SET nota = ? WHERE id = ?");
    $stmt->execute([$nota, $id]);

    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM Notas WHERE aluno_id = ?");
$stmt->execute([$id]);
$nota = $stmt->fetch();

?>

<form method="POST" action="editarNota.php">
    <input type="hidden" name="id" value="<?php echo $nota['id']; ?>">
    Nota: <input type="number" step="0.01" name="nota" value="<?php echo $nota['nota']; ?>" required>
    <input type="submit" value="Salvar">
</form>
