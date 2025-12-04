<?php
include "../../includes/sessao.php";
include "../../includes/conexao.php";

$id = $_GET['id'];

$sql = "DELETE FROM treinos WHERE id = $id";

if ($conn->query($sql)) {
    echo "<script>alert('Treino removido!'); location.href='treinos_lista.php';</script>";
} else {
    echo "Erro: " . $conn->error;
}
?>
