<a href="../../index.php" class="btn-voltar">⬅ Voltar</a>
<?php
include "../../includes/sessao.php";
include "../../includes/conexao.php";
$id = (int)($_GET['id'] ?? 0);
if ($id) { $conn->query("DELETE FROM pagamentos WHERE id=$id"); }
echo "<script>location.href='pagamentos_lista.php';</script>";
