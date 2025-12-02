<?php
session_start();
include '../includes/sessao.php';
include '../includes/conexao.php';

// token
if (!isset($_SESSION["token"])) {
    $_SESSION["token"] = bin2hex(random_bytes(32));
}

$id = $_GET['id'];

$sql = "SELECT * FROM treino WHERE id_treino = $id";
$res = $conn->query($sql);
$treino = $res->fetch_assoc();

if (!$treino) {
    die("Treino não encontrado.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_POST['token'] !== $_SESSION['token']) {
        die("Token inválido!");
    }

    $nome = trim($_POST['nome_treino']);
    $desc = trim($_POST['descricao']);
    $carga = trim($_POST['carga']);

    $update = "UPDATE treino 
               SET nome_treino='$nome',
                   descricao='$desc',
                   carga='$carga'
               WHERE id_treino=$id";

    if ($conn->query($update)) {
        $_SESSION['msg'] = "Treino atualizado!";
        header("Location: treino_list.php");
    } else {
        $_SESSION['msg'] = "Erro ao atualizar!";
        header("Location: treino_edit.php?id=$id");
    }
    exit;
}
?>

<h2>Editar Treino</h2>

<form method="POST">
    <input type="hidden" name="token" value="<?= $_SESSION["token"] ?>">

    <label>Nome:</label><br>
    <input type="text" name="nome_treino" value="<?= $treino['nome_treino'] ?>"><br><br>

    <label>Descrição:</label><br>
    <textarea name="descricao"><?= $treino['descricao'] ?></textarea><br><br>

    <label>Carga:</label><br>
    <select name="carga">
        <option <?= $treino['carga']=='Leve'?'selected':'' ?>>Leve</option>
        <option <?= $treino['carga']=='Moderada'?'selected':'' ?>>Moderada</option>
        <option <?= $treino['carga']=='Pesada'?'selected':'' ?>>Pesada</option>
    </select><br><br>

    <button type="submit">Salvar</button>
</form>
