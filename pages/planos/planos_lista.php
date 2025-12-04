<?php include "../../includes/header.php"; ?>

<h2>Lista de Planos</h2>
<a href="planos_cadastro.php"><button>Cadastrar Plano</button></a>

<?php
$res = $conn->query("SELECT * FROM planos ORDER BY id DESC");
?>

<table>
<tr>
    <th>ID</th>
    <th>Nome</th>
    <th>Valor</th>
    <th>Duração (meses)</th>
    <th>Descrição</th>
    <th>Ações</th>
</tr>

<?php while($p = $res->fetch_assoc()) { ?>
<tr>
    <td><?= $p['id'] ?></td>
    <td><?= htmlspecialchars($p['nome']) ?></td>
    <td>R$ <?= number_format($p['valor'], 2, ',', '.') ?></td>
    <td><?= $p['duracao_meses'] ?></td>
    <td><?= htmlspecialchars($p['descricao']) ?></td>
    <td>
        <a href="planos_editar.php?id=<?= $p['id'] ?>">Editar</a> |
        <a href="planos_excluir.php?id=<?= $p['id'] ?>" onclick="return confirm('Excluir plano?')">Excluir</a>
    </td>
</tr>
<?php } ?>
</table>

<?php include "../../includes/footer.php"; ?>
