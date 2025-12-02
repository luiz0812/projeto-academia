<?php
include '../includes/sessao.php';
include '../includes/conexao.php';

$mensagem = "";
if (isset($_GET['msg'])) {
    $mensagem = $_GET['msg'];
}

$sql = "SELECT * FROM plano";
$result = $conn->query($sql);
?>

<h1>Planos</h1>

<a href="plano-cadastro.php">+ Cadastrar Plano</a><br><br>

<?php if ($mensagem): ?>
    <p style="color: green;"><?= $mensagem ?></p>
<?php endif; ?>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Valor</th>
        <th>Ações</th>
    </tr>

    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['nome'] ?></td>
        <td>R$ <?= number_format($row['valor'], 2, ',', '.') ?></td>
        <td>
            <a href="plano-editar.php?id=<?= $row['id'] ?>">Editar</a> |
            <a href="plano-excluir.php?id=<?= $row['id'] ?>&token=<?= $_SESSION['token'] ?>"
               onclick="return confirm('Excluir este plano?');">Excluir</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
