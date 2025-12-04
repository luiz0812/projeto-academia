<?php
include "../../includes/sessao.php";
include "../../includes/conexao.php";
include "../../includes/header.php";

$sql = "SELECT * FROM treinos ORDER BY id DESC";
$result = $conn->query($sql);
?>

<h2>Lista de Treinos</h2>

<a href="treinos_cadastro.php" class="btn">+ Novo Treino</a>

<table border="1" cellpadding="10" width="100%">
    <tr>
        <th>ID</th>
        <th>Nome do Treino</th>
        <th>Descrição</th>
        <th>Ações</th>
    </tr>

    <?php while($t = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= $t['id']; ?></td>
        <td><?= $t['nome']; ?></td>
        <td><?= $t['descricao']; ?></td>
        <td>
            <a class="btn edit" href="treinos_editar.php?id=<?= $t['id']; ?>">Editar</a>
            <a class="btn delete" href="treinos_excluir.php?id=<?= $t['id']; ?>">Excluir</a>
        </td>
    </tr>
    <?php } ?>
</table>

<?php include "../../includes/footer.php"; ?>
