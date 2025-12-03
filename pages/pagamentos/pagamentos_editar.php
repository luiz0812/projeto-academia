<?php 
include "../includes/header.php";

$id = $_GET['id'];

$pag = $conn->query("SELECT * FROM pagamentos WHERE id = $id")->fetch_assoc();

$matriculas = $conn->query("
    SELECT m.id, a.nome, m.plano 
    FROM matriculas m
    JOIN alunos a ON m.aluno_id = a.id
");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $matricula_id = $_POST['matricula_id'];
    $valor = $_POST['valor'];
    $data_pagamento = $_POST['data_pagamento'];
    $metodo = $_POST['metodo'];
    $status = $_POST['status'];

    $sql = "UPDATE pagamentos SET 
        matricula_id = '$matricula_id',
        valor = '$valor',
        data_pagamento = '$data_pagamento',
        metodo = '$metodo',
        status = '$status'
        WHERE id = $id";

    if ($conn->query($sql)) {
        header("Location: listar.php");
        exit;
    }
}
?>

<h2>Editar Pagamento</h2>

<form method="POST">

    <label>Matrícula:</label>
    <select name="matricula_id">
        <?php while($m = $matriculas->fetch_assoc()): ?>
            <option value="<?= $m['id'] ?>" <?= $m['id']==$pag['matricula_id']?'selected':'' ?>>
                <?= $m['nome'] ?> - <?= $m['plano'] ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <label>Valor:</label>
    <input type="number" step="0.01" name="valor" value="<?= $pag['valor'] ?>" required><br><br>

    <label>Data:</label>
    <input type="date" name="data_pagamento" value="<?= $pag['data_pagamento'] ?>" required><br><br>

    <label>Método:</label>
    <select name="metodo">
        <option value="pix" <?= $pag['metodo']=='pix'?'selected':'' ?>>PIX</option>
        <option value="dinheiro" <?= $pag['metodo']=='dinheiro'?'selected':'' ?>>Dinheiro</option>
        <option value="cartao" <?= $pag['metodo']=='cartao'?'selected':'' ?>>Cartão</option>
    </select><br><br>

    <label>Status:</label>
    <select name="status">
        <option value="pago" <?= $pag['status']=='pago'?'selected':'' ?>>Pago</option>
        <option value="pendente" <?= $pag['status']=='pendente'?'selected':'' ?>>Pendente</option>
    </select><br><br>

    <button type="submit">Salvar</button>
</form>

<?php include "../includes/footer.php"; ?>
