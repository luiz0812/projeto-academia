<?php
include "../../includes/sessao.php";
include "../../includes/conexao.php";
include "../../includes/header.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $conn->real_escape_string($_POST['nome']);
    $email = $conn->real_escape_string($_POST['email']);
    $telefone = $conn->real_escape_string($_POST['telefone']);
    $data_nasc = $conn->real_escape_string($_POST['data_nascimento']);

    $sql = "INSERT INTO alunos (nome, email, telefone, data_nascimento) VALUES ('$nome','$email','$telefone','$data_nasc')";
    if ($conn->query($sql)) {
        echo "<script>location.href='aluno_lista.php';</script>";
        exit;
    } else {
        $erro = $conn->error;
    }
}
?>
<div class="container">
    <h2>Cadastrar Aluno</h2>
    <?php if(!empty($erro)) echo "<p class='error'>Erro: $erro</p>"; ?>
    <form method="POST">
        <label>Nome</label>
        <input type="text" name="nome" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Telefone</label>
        <input type="text" name="telefone">

        <label>Data de nascimento</label>
        <input type="date" name="data_nascimento">

        <input type="submit" value="Salvar">
    </form>
</div>
<?php include "../../includes/footer.php"; ?>
