<?php
include "../../includes/sessao.php";
include "../../includes/conexao.php";
include "../../includes/header.php";
$id = (int)($_GET['id'] ?? 0);
$pl = $conn->query("SELECT * FROM planos WHERE id=$id")->fetch_assoc();
if (!$pl) { echo "<p>Plano não encontrado.</p>"; include "../../includes/footer.php"; exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $conn->real_escape_string($_POST['nome']);
    $valor = $conn->real_escape_string($_POST['valor']);
    $duracao = (int)$_POST['duracao_meses'];
    $descricao = $conn->real_escape_string($_POST['descricao']);
    if ($conn->query("UPDATE planos SET nome='$nome', valor='$valor', duracao_meses=$duracao, descricao='$descricao' WHERE id=$id")) {
        echo "<script>location.href='planos_lista.php';</script>"; exit;
    } else { $erro = $conn->error; }
}
?>
<div class="container">
    <h2>Editar Plano #<?= $id ?></h2>
    <?php if(!empty($erro)) echo "<p class='error'>Erro: $erro</p>"; ?>
    <form method="POST">
        <label>Nome</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($pl['nome']) ?>" required>
        <label>Valor</label>
        <input type="text" name="valor" value="<?= $pl['valor'] ?>" required>
        <label>Duração (meses)</label>
        <input type="number" name="duracao_meses" min="1" value="<?= $pl['duracao_meses'] ?>" required>
        <label>Descrição</label>
        <input type="text" name="descricao" value="<?= htmlspecialchars($pl['descricao']) ?>">
        <input type="submit" value="Salvar Alterações">
    </form>
</div>
<?php include "../../includes/footer.php"; ?>
