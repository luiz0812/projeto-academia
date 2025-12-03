<?php 
include "../includes/header.php";

$alunos = $conn->query("SELECT * FROM alunos ORDER BY nome");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $aluno_id = $_POST['aluno_id'];
    $plano = $_POST['plano'];
    $data_matricula = $_POST['data_matricula'];

    $sql = "INSERT INTO matriculas (aluno_id, plano, data_matricula)
            VALUES ('$aluno_id', '$plano', '$data_matricula')";

    if ($conn->query($sql)) {
        header("Location: listar.php");
        exit;
    }
}
?>

<h2>Cadastrar Matrícula</h2>

<form method="POST">
    <label>Aluno:</label>
    <select name="aluno_id" required>
        <option value="">Selecione...</option>
        <?php while($a = $alunos->fetch_assoc()): ?>
            <option value="<?= $a['id'] ?>"><?= $a['nome'] ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <label>Plano:</label>
    <input type="text" name="plano" required><br><br>

    <label>Data da Matrícula:</label>
    <input type="date" name="data_matricula" required><br><br>

    <button type="submit">Cadastrar</button>
</form>

<?php include "../includes/footer.php"; ?>
