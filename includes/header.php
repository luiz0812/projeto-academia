<?php
// header.php fica em /includes
if (!isset($_SESSION)) session_start();
include "conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Sistema Academia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- caminho absoluto espera projeto em /projeto-academia/ na raiz do servidor -->
    <link rel="stylesheet" href="/projeto-academia/css/style.css">
</head>
<body>
<header class="topbar">
    <div class="wrap">
        <h1 class="brand"><a href="/projeto-academia/index.php">Academia</a></h1>
        <nav class="mainnav">
            <a href="/projeto-academia/index.php">Início</a>
            <a href="/projeto-academia/pages/aluno/aluno_lista.php">Alunos</a>
            <a href="/projeto-academia/pages/treinos/treinos_lista.php">Treinos</a>
            <a href="/projeto-academia/pages/planos/planos_lista.php">Planos</a>
            <a href="/projeto-academia/pages/matriculas/matriculas_lista.php">Matrículas</a>
            <a href="/projeto-academia/pages/pagamentos/pagamentos_lista.php">Pagamentos</a>
        </nav>
    </div>
</header>
<main class="wrap content">
