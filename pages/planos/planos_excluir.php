<?php
include "../../includes/conexao.php";

$id = (int)$_GET['id'];
// opcional: checar se há matrículas vinculadas antes de excluir
$conn->query("DELETE FROM planos WHERE id=$id");

echo "<script>alert('Plano excluído'); location.href='planos_lista.php';</script>";
