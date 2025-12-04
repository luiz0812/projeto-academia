<?php
include "../../includes/sessao.php";
include "../../includes/conexao.php";
include "../../includes/header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    $sql = "INSERT INTO treinos (nome, descricao) VALUES ('$nome', '$descricao')";

    if ($conn->query($sql)) {
        echo "<script>alert('Treino cadastrado!'); location.href='treinos_lista.php';</script>";
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>

<h2>Cadastrar Treino</h2>

<form method="POST">
    <label>Nome do Treino:</label>
    <input type="text" name="nome" required>

    <label>Descrição:</label>
    <textarea name="descricao" required></textarea>

    <button type="submit" class="btn">Cadastrar</button>
</form>

<?php include "../../includes/footer.php"; ?>
