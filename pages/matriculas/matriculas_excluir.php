<?php
include "../../includes/conexao.php";

$id = (int)$_GET['id'];

// antes de excluir, você pode verificar pagamentos vinculados — aqui apenas exclui:
$conn->query("DELETE FROM matriculas WHERE id=$id");

echo "<script>alert('Matrícula excluída'); location.href='matriculas_lista.php';</script>";
