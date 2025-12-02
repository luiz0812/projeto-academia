<?php
include '../includes/sessao.php';
include '../includes/conexao.php';

$id = $_GET['id'];

// Busca dados
$sql = "SELECT * FROM aluno WHERE id=$id";
$aluno = $conn->query($sql)->fetch_assoc();

$erro = "";
$sucesso = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ($_POST['token'] !== $_SESSION['token']) {
        die("Token inválido");
    }

    $nome = trim($_POST['nome']);
    $idade = trim($_POST['idade']);

    if ($nome == "" || $idade == "") {
        $erro = "Preencha todos os campos!";
    } else {
        $sql = "UPDATE aluno SET nome='$nome', idade='$idade' WHERE id=$id";

        if ($conn->query($sql)) {
            header("Location: aluno-lista.php?msg=Aluno atualizado!");
            exit;
        } else {
            $erro = "Erro ao atualizar!";
        }
    }
}
?>

<h1>Editar Aluno</h1>

<?php if ($erro): ?>
    <p style="color:red;"><?= $erro ?></p>
<?php endif; ?>

<form method="post">
    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

    Nome:<br>
    <input type="text" name="nome" value="<?= $aluno['nome'] ?>"><br><br>

    Idade:<br>
    <input type="number" name="idade" value="<?= $aluno['idade'] ?>"><br><br>

    <button type="submit">Salvar</button>
</form>

<a href="aluno-lista.php">Voltar</a>
