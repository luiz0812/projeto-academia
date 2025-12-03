<?php
// includes/header.php
include_once __DIR__ . '/sessao.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Sistema Academia</title>
  <link rel="stylesheet" href="/projeto-academia/css/style.css">
</head>
<body>
<header class="topbar">
  <h1><a href="/projeto-academia/index.php">Academia</a></h1>
  <nav>
    <a href="/projeto-academia/index.php">Início</a>
    <a href="/projeto-academia/alunos/listar.php">Alunos</a>
    <a href="/projeto-academia/planos/listar.php">Planos</a>
    <a href="/projeto-academia/treinos/listar.php">Treinos</a>
  </nav>
</header>
<main class="container">
<?php
// mostra flash se existir
$msg = flash('success');
if ($msg) {
    echo "<div class='flash success'>{$msg}</div>";
}
$err = flash('error');
if ($err) {
    echo "<div class='flash error'>{$err}</div>";
}
?>
