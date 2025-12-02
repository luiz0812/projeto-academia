<?php
require "../includes/sessao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Matrícula</title>
</head>
<body>

<h2>Cadastrar Matrícula</h2>

<form action="inserir-matricula.php" method="POST">

    <label>Aluno:</label>
    <input type="number" name="aluno_id" required><br><br>

    <label>Plano:</label>
    <input type="number" name="plano_id" required><br><br>

    <label>Data da Matrícula:</label>
    <input type="date" name="data_matricula" required><br><br>

    <button type="submit">Salvar</button>

</form>

</body>
</html>
