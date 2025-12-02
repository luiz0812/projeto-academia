<?php
require "../includes/sessao.php";
require "../includes/conexao.php";

$aluno_id = $_POST['aluno_id'];
$plano_id = $_POST['plano_id'];
$data_matricula = $_POST['data_matricula'];

$sql = "INSERT INTO matricula (aluno_id, plano_id, data_matricula)
        VALUES ('$aluno_id', '$plano_id', '$data_matricula')";

if ($conn->query($sql)) {
    echo "Matrícula cadastrada com sucesso!";
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}
?>
