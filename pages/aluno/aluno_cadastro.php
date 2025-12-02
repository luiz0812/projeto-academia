<?php
include '../includes/sessao.php';
include '../includes/conexao.php';

$erro = "";
$sucesso = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Verifica token
    if ($_POST['token'] !== $_SESSION['token']) {
        die("Token inválido");
    }

    // Campos
    $nome = trim($_POST['nome']);
    $idade = trim($_POST['idade']);

    // Validação mínima
    if ($nome == "" || $idade == "") {
        $erro = "Preencha todos os campos!";
    } else {

        $sql = "INSERT INTO aluno (nome, idade) VALUES ('$nome', '$idade')";
        if ($conn->query($sql)) {
            $sucesso = "Aluno cadastrado com sucesso!";
        } else {
            $erro = "Erro ao cadastrar: " . $conn->error;
        }
    }
}
?>

<h1>Cadastrar Aluno</h1>

<?php if ($erro): ?>
    <p style="color:red;"><?= $erro ?></p>
<?php endif; ?>

<?php if ($sucesso): ?>
    <p style="color:green;"><?= $sucesso ?></p>
<?php endif; ?>

<form method="post">
    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

    Nome:<br>
    <input type="text" name="nome"><br><br>

    Idade:<br>
    <input type="number" name="idade"><br><br>

    <button type="submit">Salvar</button>
</form>

<a href="aluno-lista.php">Voltar</a>
