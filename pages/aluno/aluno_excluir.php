<?php
include "../../includes/conexao.php";
$id = $_GET['id'];

$conn->query("DELETE FROM alunos WHERE id=$id");

echo "<script>alert('Excluído com sucesso!'); location.href='aluno_lista.php';</script>";
