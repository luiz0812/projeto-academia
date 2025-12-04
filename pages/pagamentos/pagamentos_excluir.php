<?php
include "../../includes/conexao.php";

$id = (int)$_GET['id'];
$conn->query("DELETE FROM pagamentos WHERE id=$id");

echo "<script>alert('Pagamento excluído'); location.href='pagamentos_lista.php';</script>";
