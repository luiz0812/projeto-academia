<a href="../../index.php" class="btn-voltar">⬅ Voltar</a>
<?php
include "../../includes/sessao.php";
include "../../includes/conexao.php";
include "../../includes/header.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $conn->real_escape_string($_POST['nome']);
    $valor = $conn->real_escape_string($_POST['valor']);
    $duracao = (int)$_POST['duracao_meses'];
    $descricao = $conn->real_escape_string($_POST['descricao']);
    $sql = "INSERT INTO planos (nome, valor, duracao_meses, descricao) VALUES ('$nome','$valor',$duracao,'$descricao')";
    if ($conn->query($sql)) { echo "<script>location.href='planos_lista.php';</script>"; exit; } else { $erro = $conn->error; }
}
?>
<div class="container">
    <h2>Cadastrar Plano</h2>
    <?php if(!empty($erro)) echo "<p class='error'>Erro: $erro</p>"; ?>
    <form method="POST">
        <label>Nome</label>
        <input type="text" name="nome" required>
        <label>Valor</label>
        <input type="text" name="valor" placeholder="Ex: 120.00" required>
        <label>Duração (meses)</label>
        <input type="number" name="duracao_meses" min="1" value="1" required>
        <label>Descrição</label>
        <input type="text" name="descricao">
        <input type="submit" value="Salvar">
    </form>
</div>
<?php include "../../includes/footer.php"; ?>
