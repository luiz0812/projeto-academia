<?php include "../../includes/header.php"; ?>

<h2>Cadastrar Plano</h2>

if ($_POST) {
    // (este bloco será sobreescrito pela versão PHP abaixo — manter apenas form em HTML)
}
?>

<?php
if ($_POST) {
    $nome = $conn->real_escape_string($_POST['nome']);
    $valor = $conn->real_escape_string($_POST['valor']);
    $duracao = (int)$_POST['duracao_meses'];
    $descricao = $conn->real_escape_string($_POST['descricao']);

    $sql = "INSERT INTO planos (nome, valor, duracao_meses, descricao) VALUES ('$nome', '$valor', $duracao, '$descricao')";
    if ($conn->query($sql)) {
        echo "<script>alert('Plano cadastrado!'); location.href='planos_lista.php';</script>";
    } else {
        echo "<p>Erro: " . $conn->error . "</p>";
    }
}
?>

<form method="POST">
    <label>Nome do Plano</label>
    <input type="text" name="nome" required>

    <label>Valor</label>
    <input type="text" name="valor" placeholder="Ex: 120.00" required>

    <label>Duração (meses)</label>
    <input type="number" name="duracao_meses" min="1" value="1" required>

    <label>Descrição</label>
    <input type="text" name="descricao">

    <input type="submit" value="Salvar Plano">
</form>

<?php include "../../includes/footer.php"; ?>
