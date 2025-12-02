<?php
require "../includes/sessao.php";
require "../includes/conexao.php";

$id = $_POST['id'];
$aluno_id = $_POST['aluno_id'];
$plano_id = $_POST['plano_id'];
$data = $_POST['data_matricula'];
$status = $_POST['status'];

$sql = "UPDATE matricula 
        SET aluno_id='$aluno_id',
            plano_id='$plano_id',
            data_matricula='$data',
            status='$status'
        WHERE id=$id";

if ($conn->query($sql)) {
    echo "Atualizado!";
} else {
    echo "Erro: " . $conn->error;
}
?>
