<?php
session_start();
include '../includes/sessao.php';
include '../includes/conexao.php';

// token
if (!isset($_SESSION["token"])) {
    $_SESSION["token"] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_POST['token'] !== $_SESSION['token']) {
        die("Token inválido!");
    }

    $nome = trim($_POST['nome_treino']);
    $desc = trim($_POST['descricao']);
    $carga = trim($_POST['carga']);

    if ($nome == "") {
        $_SESSION['msg'] = "Nome do treino é obrigatório!";
        header("Location: treino_add.php");
        exit;
    }

    $sql = "INSERT INTO treino (nome_treino, descricao, carga)
            VALUES ('$nome', '$desc', '$carga')";

    if ($conn->query($sql)) {
        $_SESSION['msg'] = "Treino cadastrado!";
        header("Location: treino_list.php");
    } else {
        $_SESSION['msg'] = "Erro ao cadastrar!";
        header("Location: treino_add.php");
    }
    exit;
}
?>

<h2>Cadastrar Treino</h2>

<form method="POST">
    <input type="hidden" name="token" value="<?= $_SESSION["token"] ?>">

    <label>Nome:</label><br>
    <input type="text" name="nome_treino"><br><br>

    <label>Descrição:</label><br>
    <textarea name="descricao"></textarea><br><br>

    <label>Carga:</label><br>
    <select name="carga">
        <option>Leve</option>
        <option>Moderada</option>
        <option>Pesada</option>
    </select><br><br>

    <button type="submit">Salvar</button>
</form>
