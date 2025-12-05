<a href="../../index.php" class="btn-voltar">⬅ Voltar</a>
<?php
include "../../includes/sessao.php";
include "../../includes/conexao.php";
include "../../includes/header.php";

$id = (int)($_GET['id'] ?? 0);
$pg = $conn->query("SELECT * FROM pagamentos WHERE id=$id")->fetch_assoc();
if (!$pg) { echo "<p>Pagamento não encontrado.</p>"; include "../../includes/footer.php"; exit; }

$matriculas = $conn->query("SELECT m.id, a.nome FROM matriculas m LEFT JOIN alunos a ON m.aluno_id = a.id ORDER BY m.id DESC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matricula_id = (int)$_POST['matricula_id'];
    $valor = $conn->real_escape_string($_POST['valor']);
    $data = $conn->real_escape_string($_POST['data_pagamento']);
    $status = $conn->real_escape_string($_POST['status']);

    if ($conn->query("UPDATE pagamentos SET matricula_id=$matricula_id, valor='$valor', data_pagamento='$data', status='$status' WHERE id=$id")) {
        echo "<script>location.href='pagamentos_lista.php';</script>"; exit;
    } else { $erro = $conn->error; }
}
?>
<div class="container">
    <h2>Editar Pagamento #<?= $id ?></h2>
    <?php if(!empty($erro)) echo "<p class='error'>Erro: $erro</p>"; ?>
    <form method="POST">
        <label>Matrícula (Aluno)</label>
        <select name="matricula_id" required>
            <?php while($m=$matriculas->fetch_assoc()){
                $sel = ($m['id'] == $pg['matricula_id']) ? 'selected' : '';
            ?>
            <option value="<?= $m['id'] ?>" <?= $sel ?>><?= htmlspecialchars($m['id'] . " - " . $m['nome']) ?></option>
            <?php } ?>
        </select>

        <label>Valor</label>
        <input type="text" name="valor" value="<?= $pg['valor'] ?>" required>

        <label>Data</label>
        <input type="date" name="data_pagamento" value="<?= $pg['data_pagamento'] ?>" required>

        <label>Status</label>
        <select name="status" required>
            <option value="Pago" <?= $pg['status']=='Pago'?'selected':'' ?>>Pago</option>
            <option value="Pendente" <?= $pg['status']=='Pendente'?'selected':'' ?>>Pendente</option>
        </select>

        <input type="submit" value="Salvar Alterações">
    </form>
</div>
<?php include "../../includes/footer.php"; ?>
