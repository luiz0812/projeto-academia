<?php include "../../includes/header.php"; ?>

<h2>Registrar Pagamento</h2>

<?php
$matriculas = $conn->query("SELECT m.id, a.nome AS aluno FROM matriculas m LEFT JOIN alunos a ON m.aluno_id = a.id ORDER BY m.id DESC");

if ($_POST) {
    $matricula_id = (int)$_POST['matricula_id'];
    $valor = $conn->real_escape_string($_POST['valor']);
    $data = $conn->real_escape_string($_POST['data_pagamento']);
    $metodo = $conn->real_escape_string($_POST['metodo']);

    $sql = "INSERT INTO pagamentos (matricula_id, valor, data_pagamento, metodo)
            VALUES ($matricula_id, '$valor', '$data', '$metodo')";
    if ($conn->query($sql)) {
        echo "<script>alert('Pagamento registrado!'); location.href='pagamentos_lista.php';</script>";
    } else {
        echo "<p>Erro: " . $conn->error . "</p>";
    }
}
?>

<form method="POST">
    <label>Matrícula (Aluno)</label>
    <select name="matricula_id" required>
        <option value="">-- selecione --</option>
        <?php while($m = $matriculas->fetch_assoc()) { ?>
            <option value="<?= $m['id'] ?>"><?= htmlspecialchars($m['id'] . " - " . $m['aluno']) ?></option>
        <?php } ?>
    </select>

    <label>Valor (usar ponto para decimal)</label>
    <input type="text" name="valor" placeholder="Ex: 120.00" required>

    <label>Data de Pagamento</label>
    <input type="date" name="data_pagamento" required>

    <label>Método</label>
    <select name="metodo" required>
        <option value="Dinheiro">Dinheiro</option>
        <option value="Cartão">Cartão</option>
        <option value="Pix">Pix</option>
        <option value="Transferência">Transferência</option>
    </select>

    <input type="submit" value="Registrar Pagamento">
</form>

<?php include "../../includes/footer.php"; ?>
