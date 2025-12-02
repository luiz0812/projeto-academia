<?php
include '../includes/sessao.php';
include '../includes/conexao.php';

// Mensagens
$mensagem = "";
if (isset($_GET['msg'])) {
    $mensagem = $_GET['msg'];
}

$sql = "SELECT * FROM aluno";
$result = $conn->query($sql);
?>

<h1>Lista de Alunos</h1>

<?php if ($mensagem): ?>
    <p style="color: green;"><?= $mensagem ?></p>
<?php endif; ?>

<a href="aluno-cadastro.php">+ Cadastrar aluno</a><br><br>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Idade</th>
        <th>Ações</th>
    </tr>

    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['nome'] ?></td>
        <td><?= $row['idade'] ?></td>
        <td>
            <a href="aluno-editar.php?id=<?= $row['id'] ?>">Editar</a> | 
            <a href="aluno-excluir.php?id=<?= $row['id'] ?>&token=<?= $_SESSION['token'] ?>"
               onclick="return confirm('Excluir aluno?');">Excluir</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
