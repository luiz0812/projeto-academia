<?php
session_start();
include '../includes/sessao.php';
include '../includes/conexao.php';

$id = $_GET['id'];

$sql = "DELETE FROM treino WHERE id_treino = $id";

if ($conn->query($sql)) {
    $_SESSION['msg'] = "Treino excluído!";
} else {
    $_SESSION['msg'] = "Erro ao excluir!";
}

header("Location: treino_list.php");
exit;
