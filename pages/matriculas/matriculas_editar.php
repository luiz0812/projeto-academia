<?php
require "../includes/sessao.php";
require "../includes/conexao.php";

$id = $_GET['id'];

$sql = "SELECT * FROM matricula WHERE id=$id";
$res = $conn->query($sql);
$matricula = $res->fetch_assoc();
?>

<h2>Editar Matrícula</h2>

<form action="atualizar-matricula.php" method="POST">
    <input type="hidden" name="id" value="<?= $matricula['id'] ?>">

    <label>Aluno ID:</label>
    <input type="number" name="aluno_id" value="<?= $matricula['aluno_id'] ?>" required><br><br>

    <label>Plano ID:</label>
    <input type="number" name="plano_id" value="<?= $matricula['plano_id'] ?>" required><br><br>

    <label>Data da Matrícula:</label>
    <input type="date" name="data_matricula" value="<?= $matricula['data_matricula'] ?>" required><br><br>

    <label>Status:</label>
    <select name="status">
        <option value="ativa" <?= $matricula['status']=='ativa'?'selected':'' ?>>Ativa</option>
        <option value="cancelada" <?= $matricula['status']=='cancelada'?'selected':'' ?>>Cancelada</option>
    </select><br><br>

    <button type="submit">Salvar</button>
</form>
