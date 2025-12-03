<?php 
include "../includes/header.php";

$id = $_GET['id'];

$alunos = $conn->query("SELECT * FROM alunos ORDER BY nome");
$mat = $conn->query("SELECT * FROM matriculas WHERE id = $id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $aluno_id = $_POST['aluno_id'];
    $plano = $_POST['plano'];
    $data_matricula = $_POST['data_matricula'];
    $status = $_POST['status'];

    $sql = "UPDATE matriculas SET 
        aluno_id = '$aluno_id',
        plano = '$plano',
        data_matricula = '$data_matricula',
        status = '$status'
        WHERE id = $id";

    if ($conn->query($sql)) {
        header("Location: listar.php");
        exit;
    }
}
?>

<h2>Editar Matrícula</h2>

<form method="POST">
    <label>Aluno:</label>
    <select name="aluno_id" required>
        <?php while($a = $alunos->fetch_assoc()): ?>
            <option value="<?= $a['id'] ?>" <?= $a['id']==$mat['aluno_id']?'selected':'' ?>>
                <?= $a['nome'] ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <label>Plano:</label>
    <input type="text" name="plano" value="<?= $mat['plano'] ?>" required><br><br>

    <label>Data Matrícula:</label>
    <input type="date" name="data_matricula" value="<?= $mat['data_matricula'] ?>" required><br><br>

    <label>Status:</label>
    <select name="status">
        <option value="ativa" <?= $mat['status']=='ativa'?'selected':'' ?>>Ativa</option>
        <option value="inativa" <?= $mat['status']=='inativa'?'selected':'' ?>>Inativa</option>
    </select><br><br>

    <button type="submit">Salvar Alterações</button>
</form>

<?php include "../includes/footer.php"; ?>
