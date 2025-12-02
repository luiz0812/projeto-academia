<?php
include '../includes/sessao.php';
include '../includes/conexao.php';

$id = $_GET['id'];

$sql = "SELECT * FROM plano WHERE id=$id";
$plano = $conn->query($sql)->fetch_assoc();

$erro = "";
$sucesso = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ($_POST['token'] !== $_SESSION['token']) {
        die("Token inválido!");
    }

    $nome  = trim($_POST['nome']);
    $valor = trim($_POST['valor']);

    if ($nome == "" || $valor == "") {
        $erro = "Preencha todos os campos!";
    } else if (!is_numeric($valor)) {
        $erro = "O valor deve ser numérico!";
    } else {
        $sql = "UPDATE plano SET nome='$nome', valor='$valor' WHERE id=$id";
        if ($conn->query($sql)) {
            header("Location: plano-lista.php?msg=Plano atualizado!");
            exit;
        } else {
            $erro = "Erro ao atualizar!";
        }
    }
}
?>

<h1>Editar Plano</h1>

<?php if ($erro): ?>
    <p style="color:red;"><?= $erro ?></p>
<?php endif; ?>

<form method="post">
    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

    Nome do plano:<br>
    <input type="text" name="nome" value="<?= $plano['nome'] ?>"><br><br>

    Valor (R$):<br>
    <input type="text" name="valor" value="<?= $plano['valor'] ?>"><br><br>

    <button type="submit">Salvar</button>
</form>

<br>
<a href="plano-lista.php">Voltar</a>
