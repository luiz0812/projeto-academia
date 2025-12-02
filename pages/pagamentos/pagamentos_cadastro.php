<?php
session_start();
include '../includes/sessao.php';
include '../includes/conexao.php';

// token
if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

// Carregar alunos
$alunos = $conn->query("SELECT * FROM aluno ORDER BY nome ASC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_POST['token'] !== $_SESSION['token']) {
        die("Token inválido!");
    }

    $id_aluno = $_POST['id_aluno'];
    $valor = $_POST['valor'];
    $data = $_POST['data_pagamento'];
    $status = $_POST['status'];

    if ($valor == "" || $id_aluno == "") {
        $_SESSION['msg'] = "Preencha aluno e valor!";
        header("Location: pagamento_add.php");
        exit;
    }

    $sql = "INSERT INTO pagamento (id_aluno, valor, data_pagamento, status)
            VALUES ($id_aluno, '$valor', '$data', '$status')";

    if ($conn->query($sql)) {
        $_SESSION['msg'] = "Pagamento registrado!";
        header("Location: pagamento_list.php");
    } else {
        $_SESSION['msg'] = "Erro ao registrar!";
        header("Location: pagamento_add.php");
    }
    exit;
}
?>

<h2>Registrar Pagamento</h2>

<form method="POST">
    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

    <label>Aluno:</label><br>
    <select name="id_aluno">
        <option value="">Selecione...</option>
        <?php while ($a = $alunos->fetch_assoc()) { ?>
            <option value="<?= $a['id_aluno'] ?>"><?= $a['nome'] ?></option>
        <?php } ?>
    </select><br><br>

    <label>Valor:</label><br>
    <input type="number" step="0.01" name="valor"><br><br>

    <label>Data:</label><br>
    <input type="date" name="data_pagamento"><br><br>

    <label>Status:</label><br>
    <select name="status">
        <option>Pago</option>
        <option>Pendente</option>
    </select><br><br>

    <button type="submit">Salvar</button>
</form>
