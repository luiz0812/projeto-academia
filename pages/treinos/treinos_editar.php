<?php
include "../../includes/sessao.php";
include "../../includes/conexao.php";
include "../../includes/header.php";

$id = $_GET['id'];

$sql = "SELECT * FROM treinos WHERE id = $id";
$result = $conn->query($sql);
$treino = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    $update = "UPDATE treinos SET nome='$nome', descricao='$descricao' WHERE id=$id";

    if ($conn->query($update)) {
        echo "<script>alert('Treino atualizado!'); location.href='treinos_lista.php';</script>";
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>

<h2>Editar Treino</h2>

<form method="POST">
    <label>Nome do Treino:</label>
    <input type="text" name="nome" value="<?= $treino['nome']; ?>" required>

    <label>Descrição:</label>
    <textarea name="descricao" required><?= $treino['descricao']; ?></textarea>

    <button type="submit" class="btn">Salvar</button>
</form>

<?php include "../../includes/footer.php"; ?>
