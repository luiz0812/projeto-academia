<?php 
include "../includes/header.php";

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

    $sql = "INSERT INTO pagamentos (matricula_id, valor, data_pagamento, metodo)
            VALUES ('$matricula_id', '$valor', '$data_pagamento', '$metodo')";

    if ($conn->query($sql)) {
        header("Location: listar.php");
        exit;
    }
}
?>

<h2>Registrar Pagamento</h2>

<form method="POST">

    <label>Matrícula:</label>
    <select name="matricula_id" required>
        <option value="">Selecione...</option>
        <?php while($m = $matriculas->fetch_assoc()): ?>
            <option value="<?= $m['id'] ?>">
                <?= $m['nome'] ?> - <?= $m['plano'] ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <label>Valor:</label>
    <input type="number" step="0.01" name="valor" required><br><br>

    <label>Data:</label>
    <input type="date" name="data_pagamento" required><br><br>

    <label>Método:</label>
    <select name="metodo" required>
        <option value="pix">PIX</option>
        <option value="dinheiro">Dinheiro</option>
        <option value="cartao">Cartão</option>
    </select><br><br>

    <button type="submit">Registrar</button>
</form>

<?php include "../includes/footer.php"; ?>
