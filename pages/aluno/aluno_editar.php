<?php include "../../includes/header.php"; ?>

<?php
$id = $_GET['id'];
$r = $conn->query("SELECT * FROM alunos WHERE id=$id")->fetch_assoc();
?>

<h2>Editar Aluno</h2>

<form method="POST">
    <input type="text" name="nome" value="<?= $r['nome'] ?>" required>
    <input type="text" name="telefone" value="<?= $r['telefone'] ?>" required>
    <input type="submit" value="Salvar Alterações">
</form>

<?php
if ($_POST) {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];

    $conn->query("UPDATE alunos SET nome='$nome', telefone='$telefone' WHERE id=$id");
    echo "<script>alert('Alterado!'); location.href='aluno_lista.php';</script>";
}
?>

<?php include "../../includes/footer.php"; ?>
