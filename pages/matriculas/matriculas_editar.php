<a href="../../index.php" class="btn-voltar">⬅ Voltar</a>
<?php
include "../../includes/sessao.php";
include "../../includes/conexao.php";
include "../../includes/header.php";

$id = (int)($_GET['id'] ?? 0);
$mat = $conn->query("SELECT * FROM matriculas WHERE id=$id")->fetch_assoc();
if (!$mat) { echo "<p>Matrícula não encontrada.</p>"; include "../../includes/footer.php"; exit; }

$alunos = $conn->query("SELECT id,nome FROM alunos ORDER BY nome");
$planos = $conn->query("SELECT id,nome FROM planos ORDER BY nome");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aluno_id = (int)$_POST['aluno_id'];
    $plano_id = (int)$_POST['plano_id'];
    $data = $conn->real_escape_string($_POST['data_matricula']);
    $status = $conn->real_escape_string($_POST['status']);

    if ($conn->query("UPDATE matriculas SET aluno_id=$aluno_id, plano_id=$plano_id, data_matricula='$data', status='$status' WHERE id=$id")) {
        echo "<script>location.href='matriculas_lista.php';</script>"; exit;
    } else { $erro = $conn->error; }
}
?>
<div class="container">
    <h2>Editar Matrícula #<?= $id ?></h2>
    <?php if(!empty($erro)) echo "<p class='error'>Erro: $erro</p>"; ?>
    <form method="POST">
        <label>Aluno</label>
        <select name="aluno_id" required>
            <?php while($a=$alunos->fetch_assoc()){
                $sel = ($a['id'] == $mat['aluno_id']) ? 'selected' : '';
            ?>
            <option value="<?= $a['id'] ?>" <?= $sel ?>><?= htmlspecialchars($a['nome']) ?></option>
            <?php } ?>
        </select>

        <label>Plano</label>
        <select name="plano_id" required>
            <?php while($p=$planos->fetch_assoc()){
                $sel = ($p['id'] == $mat['plano_id']) ? 'selected' : '';
            ?>
            <option value="<?= $p['id'] ?>" <?= $sel ?>><?= htmlspecialchars($p['nome']) ?></option>
            <?php } ?>
        </select>

        <label>Data da matrícula</label>
        <input type="date" name="data_matricula" value="<?= $mat['data_matricula'] ?>" required>

        <label>Status</label>
        <select name="status" required>
            <option value="Ativa" <?= $mat['status']=='Ativa'?'selected':'' ?>>Ativa</option>
            <option value="Inativa" <?= $mat['status']=='Inativa'?'selected':'' ?>>Inativa</option>
        </select>

        <input type="submit" value="Salvar Alterações">
    </form>
</div>
<?php include "../../includes/footer.php"; ?>
