<?php
include "../../includes/sessao.php";
include "../../includes/conexao.php";
include "../../includes/header.php";

$matriculas = $conn->query("SELECT m.id, a.nome FROM matriculas m LEFT JOIN alunos a ON m.aluno_id = a.id ORDER BY m.id DESC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matricula_id = (int)$_POST['matricula_id'];
    $valor = $conn->real_escape_string($_POST['valor']);
    $data = $conn->real_escape_string($_POST['data_pagamento']);
    $status = $conn->real_escape_string($_POST['status']);

    $sql = "INSERT INTO pagamentos (matricula_id, valor, data_pagamento, status) VALUES ($matricula_id, '$valor', '$data', '$status')";
    if ($conn->query($sql)) { echo "<script>location.href='pagamentos_lista.php';</script>"; exit; } else { $erro = $conn->error; }
}
?>
<div class="container">
    <h2>Registrar Pagamento</h2>
    <?php if(!empty($erro)) echo "<p class='error'>Erro: $erro</p>"; ?>
    <form method="POST">
        <label>Matrícula (Aluno)</label>
        <select name="matricula_id" required>
            <option value="">-- selecione --</option>
            <?php while($m=$matriculas->fetch_assoc()){ ?>
                <option value="<?= $m['id'] ?>"><?= htmlspecialchars($m['id'] . " - " . $m['nome']) ?></option>
            <?php } ?>
        </select>

        <label>Valor</label>
        <input type="text" name="valor" placeholder="Ex: 120.00" required>

        <label>Data</label>
        <input type="date" name="data_pagamento" required>

        <label>Status</label>
        <select name="status" required>
            <option value="Pago">Pago</option>
            <option value="Pendente">Pendente</option>
        </select>

        <input type="submit" value="Registrar">
    </form>
</div>
<?php include "../../includes/footer.php"; ?>
