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

    $stmt = $conn->prepare("INSERT INTO notas (aluno_id, professor_id, disciplina, nota, data) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$aluno_id, $professor_id, $disciplina, $nota, $data]);

    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Nota</title>
    <link rel="stylesheet" href="../css/AdicionarNota.css">

</head>
<body>
    
    <form method="POST">
        <h1>Adicionar Nota</h1>
        <label for="aluno">Aluno:</label>
        <select name="aluno_id" id="aluno" required>
            <option value="">Selecione um aluno</option>
            <?php foreach ($alunos as $aluno): ?>
                <option value="<?= htmlspecialchars($aluno['id']) ?>">
                    <?= htmlspecialchars($aluno['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>

        <label for="disciplina">Disciplina:</label>
        <input type="text" name="disciplina" id="disciplina" required>
        <br>

        <label for="nota">Nota:</label>
        <input type="number" step="0.01" name="nota" id="nota" required>
        <br>

        <label for="data">Data:</label>
        <input type="date" name="data" id="data" required>
        <br>

        <input type="submit" value="Adicionar Nota">
    </form>
</body>
</html>

