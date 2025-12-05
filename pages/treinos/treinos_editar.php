<a href="../../index.php" class="btn-voltar">⬅ Voltar</a>
<?php
include "../../includes/sessao.php";
include "../../includes/conexao.php";
include "../../includes/header.php";

$id = (int)($_GET['id'] ?? 0);
$tr = $conn->query("SELECT * FROM treinos WHERE id=$id")->fetch_assoc();
if (!$tr) { echo "<p>Treino não encontrado.</p>"; include "../../includes/footer.php"; exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $conn->real_escape_string($_POST['nome']);
    $descricao = $conn->real_escape_string($_POST['descricao']);
    if ($conn->query("UPDATE treinos SET nome='$nome', descricao='$descricao' WHERE id=$id")) {
        echo "<script>location.href='treinos_lista.php';</script>"; exit;
    } else { $erro = $conn->error; }
}
?>
<div class="container">
    <h2>Editar Treino #<?= $id ?></h2>
    <?php if(!empty($erro)) echo "<p class='error'>Erro: $erro</p>"; ?>
    <form method="POST">
        <label>Nome</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($tr['nome']) ?>" required>
        <label>Descrição</label>
        <textarea name="descricao" required><?= htmlspecialchars($tr['descricao']) ?></textarea>
        <input type="submit" value="Salvar">
    </form>
</div>
<?php include "../../includes/footer.php"; ?>
