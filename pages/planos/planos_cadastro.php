<?php
include '../includes/sessao.php';
include '../includes/conexao.php';

$erro = "";
$sucesso = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ($_POST['token'] !== $_SESSION['token']) {
        die("Token inválido!");
    }

    $nome  = trim($_POST['nome']);
    $valor = trim($_POST['valor']);

    // Validação
    if ($nome == "" || $valor == "") {
        $erro = "Preencha todos os campos!";
    } else if (!is_numeric($valor)) {
        $erro = "O valor deve ser numérico!";
    } else {
        $sql = "INSERT INTO plano (nome, valor) VALUES ('$nome', '$valor')";
        if ($conn->query($sql)) {
            $sucesso = "Plano cadastrado com sucesso!";
        } else {
            $erro = "Erro ao cadastrar: " . $conn->error;
        }
    }
}
?>

<h1>Cadastrar Plano</h1>

<?php if ($erro): ?>
    <p style="color:red;"><?= $erro ?></p>
<?php endif; ?>

<?php if ($sucesso): ?>
    <p style="color:green;"><?= $sucesso ?></p>
<?php endif; ?>

<form method="post">
    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

    Nome do plano:<br>
    <input type="text" name="nome"><br><br>

    Valor (R$):<br>
    <input type="text" name="valor"><br><br>

    <button type="submit">Salvar</button>
</form>

<br>
<a href="plano-lista.php">Voltar</a>
