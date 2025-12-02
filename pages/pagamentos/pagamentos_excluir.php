<?php
session_start();
include '../includes/sessao.php';
include '../includes/conexao.php';

$id = $_GET['id'];

$sql = "DELETE FROM pagamento WHERE id_pagamento = $id";

if ($conn->query($sql)) {
    $_SESSION['msg'] = "Pagamento excluído!";
} else {
    $_SESSION['msg'] = "Erro ao excluir!";
}

header("Location: pagamento_list.php");
exit;
