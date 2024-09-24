<?php
session_start();
require '../conexao/conexao.php';

if (!isset($_SESSION['professor_id'])) {
    header("Location: index.php");
    exit();
}

// Obter a lista de alunos
$stmt = $conn->prepare("SELECT id, nome FROM Alunos");
$stmt->execute();
$alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $aluno_id = $_POST['aluno_id'];
    $disciplina = $_POST['disciplina'];
    $nota = $_POST['nota'];
    $data = $_POST['data'];
    $professor_id = $_SESSION['professor_id'];

    $stmt = $conn->prepare("INSERT INTO Notas (aluno_id, professor_id, disciplina, nota, data) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$aluno_id, $professor_id, $disciplina, $nota, $data]);

    header("Location: dashboard.php");
    exit();
}
?>

<form method="POST" action="adicionar_nota.php">
    Aluno:
    <select name="aluno_id" required>
        <option value="">Selecione um aluno</option>
        <?php foreach ($alunos as $aluno): ?>
            <option value="<?= htmlspecialchars($aluno['id']) ?>">
                <?= htmlspecialchars($aluno['nome']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br>
    Disciplina: <input type="text" name="disciplina" required>
    <br>
    Nota: <input type="number" step="0.01" name="nota" required>
    <br>
    Data: <input type="date" name="data" required>
    <br>
    <input type="submit" value="Adicionar Nota">
</form>
