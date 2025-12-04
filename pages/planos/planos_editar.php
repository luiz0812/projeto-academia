<?php include "../../includes/header.php"; ?>

<?php
$id = (int)$_GET['id'];
$pl = $conn->query("SELECT * FROM planos WHERE id=$id")->fetch_assoc();
if (!$pl) {
    echo "<p>Plano não encontrado.</p>";
    include "../../includes/footer.php";
    exit;
}

if ($_POST) {
    $nome = $conn->real_escape_string($_POST['nome']);
    $valor = $conn->real_escape_string($_POST['valor']);
    $duracao = (int)$_POST['duracao_meses'];
    $descricao = $conn->real_escape_string($_POST['descricao']);

    $sql = "UPDATE planos SET nome='$nome', valor='$valor', duracao_meses=$duracao, descricao='$descricao' WHERE id=$id";
    if ($conn->query($sql)) {
        echo "<script>alert('Plano atualizado!'); location.href='planos_lista.php';</script>";
    } else {
        echo "<p>Erro: " . $conn->error . "</p>";
    }
}
?>

<h2>Editar Plano #<?= $id ?></h2>

<form method="POST">
    <label>Nome do Plano</label>
    <input type="text" name="nome" value="<?= htmlspecialchars($pl['nome']) ?>" required>

    <label>Valor</label>
    <input type="text" name="valor" value="<?= $pl['valor'] ?>" required>

    <label>Duração (meses)</label>
    <input type="number" name="duracao_meses" min="1" value="<?= $pl['duracao_meses'] ?>" required>

    <label>Descrição</label>
    <input type="text" name="descricao" value="<?= htmlspecialchars($pl['descricao']) ?>">

    <input type="submit" value="Salvar Alterações">
</form>

<?php include "../../includes/footer.php"; ?>
