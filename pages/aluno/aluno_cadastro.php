<?php include "../../includes/header.php"; ?>

<h2>Cadastrar Aluno</h2>

<form method="POST">
    <input type="text" name="nome" placeholder="Nome" required>
    <input type="text" name="telefone" placeholder="Telefone" required>
    <input type="submit" value="Salvar">
</form>

<?php
if ($_POST) {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];

    $conn->query("INSERT INTO alunos (nome, telefone) VALUES ('$nome', '$telefone')");
    echo "<script>alert('Cadastrado com sucesso!'); location.href='aluno_lista.php';</script>";
}
?>

<?php include "../../includes/footer.php"; ?>
