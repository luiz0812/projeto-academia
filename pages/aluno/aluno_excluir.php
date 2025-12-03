<?php
require "../../includes/sessao.php";
require "../../includes/header.php";

if ($_GET['token'] !== $_SESSION['token']) {
    die("Token inválido!");
}

$id = $_GET['id'];

$sql = "DELETE FROM aluno WHERE id=$id";

if ($conn->query($sql)) {
    header("Location: aluno-lista.php?msg=Aluno excluído!");
} else {
    echo "Erro ao excluir!";
}

$sqlCheck = "SELECT * FROM matricula WHERE aluno_id=$id";
$check = $conn->query($sqlCheck);

if ($check->num_rows > 0) {
    die("Erro: Não é possível excluir aluno com matrículas ativas.");
}
