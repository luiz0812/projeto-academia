<a href="../../index.php" class="btn-voltar">⬅ Voltar</a>
<?php
include "../../includes/sessao.php";
include "../../includes/conexao.php";
include "../../includes/header.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $conn->real_escape_string($_POST['nome']);
    $descricao = $conn->real_escape_string($_POST['descricao']);
    if ($conn->query("INSERT INTO treinos (nome, descricao) VALUES ('$nome','$descricao')")) {
        echo "<script>location.href='treinos_lista.php';</script>"; exit;
    } else { $erro = $conn->error; }
}
?>
<div class="container">
    <h2>Cadastrar Treino</h2>
    <?php if(!empty($erro)) echo "<p class='error'>Erro: $erro</p>"; ?>
    <form method="POST">
        <label>Nome</label>
        <input type="text" name="nome" required>
        <label>Descrição</label>
        <textarea name="descricao" required></textarea>
        <input type="submit" value="Salvar">
    </form>
</div>
<?php include "../../includes/footer.php"; ?>
