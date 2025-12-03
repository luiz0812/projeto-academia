<?php
include_once __DIR__ . '/../includes/conexao.php';
include_once __DIR__ . '/../includes/sessao.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    flash('error','Aluno inválido.');
    header('Location: listar.php');
    exit;
}

$stmt = $conn->prepare("DELETE FROM alunos WHERE id = ?");
$stmt->bind_param("i",$id);
if ($stmt->execute()) {
    flash('success','Aluno excluído.');
} else {
    flash('error','Erro ao excluir: ' . $stmt->error);
}
header('Location: listar.php');
exit;
