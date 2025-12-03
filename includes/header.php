<?php
if (!isset($_SESSION)) session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema Academia</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/estilo.css">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="../pages/index.php">Academia</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">

                <li class="nav-item"><a class="nav-link" href="../alunos/listar.php">Alunos</a></li>
                <li class="nav-item"><a class="nav-link" href="../planos/listar.php">Planos</a></li>
                <li class="nav-item"><a class="nav-link" href="../treinos/listar.php">Treinos</a></li>
                <li class="nav-item"><a class="nav-link" href="../matriculas/listar.php">Matrículas</a></li>
                <li class="nav-item"><a class="nav-link" href="../pagamentos/listar.php">Pagamentos</a></li>

            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
