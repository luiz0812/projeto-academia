<?php
include "../../includes/sessao.php";
include "../../includes/conexao.php";
$id = (int)($_GET['id'] ?? 0);
if ($id) { $conn->query("DELETE FROM treinos WHERE id=$id"); }
echo "<script>location.href='treinos_lista.php';</script>";
