<a href="../../index.php" class="btn-voltar">⬅ Voltar</a>
<?php
include "../../includes/sessao.php";
include "../../includes/conexao.php";
include "../../includes/header.php";

$id = (int)($_GET['id'] ?? 0);
$al = $conn->query("SELECT * FROM alunos WHERE id=$id")->fetch_assoc();
if (!$al) { echo "<p>Aluno não encontrado.</p>"; include "../../includes/footer.php"; exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $conn->real_escape_string($_POST['nome']);
    $email = $conn->real_escape_string($_POST['email']);
    $telefone = $conn->real_escape_string($_POST['telefone']);
    $data_nasc = $conn->real_escape_string($_POST['data_nascimento']);

    if ($conn->query("UPDATE alunos SET nome='$nome', email='$email', telefone='$telefone', data_nascimento='$data_nasc' WHERE id=$id")) {
        echo "<script>location.href='aluno_lista.php';</script>"; exit;
    } else {
        $erro = $conn->error;
    }
}
?>
<div class="container">
    <h2>Editar Aluno #<?= $id ?></h2>
    <?php if(!empty($erro)) echo "<p class='error'>Erro: $erro</p>"; ?>
    <form method="POST">
        <label>Nome</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($al['nome']) ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($al['email']) ?>" required>

        <label>Telefone</label>
        <input type="text" name="telefone" value="<?= htmlspecialchars($al['telefone']) ?>">

        <label>Data de nascimento</label>
        <input type="date" name="data_nascimento" value="<?= $al['data_nascimento'] ?>">

        <input type="submit" value="Salvar Alterações">
    </form>
</div>
<?php include "../../includes/footer.php"; ?>
