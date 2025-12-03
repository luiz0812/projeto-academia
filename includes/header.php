<?php include "conexao.php"; include "sessao.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Academia</title>

<style>
body{ background:#f3f4f6; }
.navbar{ margin-bottom:20px; }
.container-card{ max-width:900px;margin:auto; }
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/projeto-academia/index.php">Academia</a>

    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="/projeto-academia/pages/alunos/lista.php">Alunos</a></li>
        <li class="nav-item"><a class="nav-link" href="/projeto-academia/pages/planos/lista.php">Planos</a></li>
        <li class="nav-item"><a class="nav-link" href="/projeto-academia/pages/treinos/lista.php">Treinos</a></li>
        <li class="nav-item"><a class="nav-link" href="/projeto-academia/pages/pagamentos/lista.php">Pagamentos</a></li>
        <li class="nav-item"><a class="nav-link" href="/projeto-academia/pages/matriculas/lista.php">Matrículas</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-card p-4 bg-white shadow rounded">
