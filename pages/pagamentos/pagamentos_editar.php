<?php include "../../includes/header.php"; ?>

<?php
$id = (int)$_GET['id'];
$pg = $conn->query("SELECT * FROM pagamentos WHERE id=$id")->fetch_assoc();
if (!$pg) {
    echo "<p>Pagamento não encontrado.</p>";
    include "../../includes/footer.php";
    exit;
}

$matriculas = $conn->query("SELECT m.id, a.nome AS aluno FROM matriculas m LEFT JOIN alunos a ON m.aluno_id = a.id ORDER BY m.id DESC");

if ($_POST) {
    $matricula_id = (int)$_POST['matricula_id'];
    $valor = $conn->real_escape_string($_POST['valor']);
    $data = $conn->real_escape_string($_POST['data_pagamento']);
    $metodo = $conn->real_escape_string($_POST['metodo']);

    $sql = "UPDATE pagamentos SET matricula_id=$matricula_id, valor='$valor', data_pagamento='$data', metodo='$metodo' WHERE id=$id";
    if ($conn->query($sql)) {
        echo "<script>alert('Pagamento atualizado!'); location.href='pagamentos_lista.php';</script>";
    } else {
        echo "<p>Erro: " . $conn->error . "</p>";
    }
}
?>

<h2>Editar Pagamento #<?= $id ?></h2>

<form method="POST">
    <label>Matrícula (Aluno)</label>
    <select name="matricula_id" required>
        <?php while($m = $matriculas->fetch_assoc()) {
            $sel = ($m['id'] == $pg['matricula_id']) ? 'selected' : '';
        ?>
            <option value="<?= $m['id'] ?>" <?= $sel ?>><?= htmlspecialchars($m['id'] . " - " . $m['aluno']) ?></option>
        <?php } ?>
    </select>

    <label>Valor</label>
    <input type="text" name="valor" value="<?= $pg['valor'] ?>" required>

    <label>Data de Pagamento</label>
    <input type="date" name="data_pagamento" value="<?= $pg['data_pagamento'] ?>" required>

    <label>Método</label>
    <select name="metodo" required>
        <option value="Dinheiro" <?= $pg['metodo']=='Dinheiro'?'selected':'' ?>>Dinheiro</option>
        <option value="Cartão" <?= $pg['metodo']=='Cartão'?'selected':'' ?>>Cartão</option>
        <option value="Pix" <?= $pg['metodo']=='Pix'?'selected':'' ?>>Pix</option>
        <option value="Transferência" <?= $pg['metodo']=='Transferência'?'selected':'' ?>>Transferência</option>
    </select>

    <input type="submit" value="Salvar Alterações">
</form>

<?php include "../../includes/footer.php"; ?>
