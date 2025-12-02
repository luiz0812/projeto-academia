<?php
session_start();
include '../includes/sessao.php';
include '../includes/conexao.php';

// token
if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

$id = $_GET['id'];

$sql = "SELECT * FROM pagamento WHERE id_pagamento = $id";
$res = $conn->query($sql);
$p = $res->fetch_assoc();

if (!$p) {
    die("Pagamento não encontrado.");
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

    $update = "UPDATE pagamento SET
                id_aluno = $id_aluno,
                valor = '$valor',
                data_pagamento = '$data',
                status = '$status'
               WHERE id_pagamento = $id";

    if ($conn->query($update)) {
        $_SESSION['msg'] = "Pagamento atualizado!";
        header("Location: pagamento_list.php");
    } else {
        $_SESSION['msg'] = "Erro ao atualizar!";
        header("Location: pagamento_edit.php?id=$id");
    }
    exit;
}
?>

<h2>Editar Pagamento</h2>

<form method="POST">
    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

    <label>Aluno:</label><br>
    <select name="id_aluno">
        <?php while ($a = $alunos->fetch_assoc()) { ?>
            <option value="<?= $a['id_aluno'] ?>"
                <?= $a['id_aluno']==$p['id_aluno']?'selected':'' ?>>
                <?= $a['nome'] ?>
            </option>
        <?php } ?>
    </select><br><br>

    <label>Valor:</label><br>
    <input type="number" step="0.01" name="valor" 
           value="<?= $p['valor'] ?>"><br><br>

    <label>Data Pagamento:</label><br>
    <input type="date" name="data_pagamento" 
           value="<?= $p['data_pagamento'] ?>"><br><br>

    <label>Status:</label><br>
    <select name="status">
        <option <?= $p['status']=='Pago'?'selected':'' ?>>Pago</option>
        <option <?= $p['status']=='Pendente'?'selected':'' ?>>Pendente</option>
    </select><br><br>

    <button type="submit">Salvar</button>
</form>
