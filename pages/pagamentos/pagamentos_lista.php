<?php include "../../includes/header.php"; ?>

<h2>Lista de Pagamentos</h2>
<a href="pagamentos_cadastro.php"><button>Registrar Pagamento</button></a>

<?php
$sql = "SELECT pg.id, pg.valor, pg.data_pagamento, pg.metodo, m.id AS matricula_id, a.nome AS aluno
        FROM pagamentos pg
        LEFT JOIN matriculas m ON pg.matricula_id = m.id
        LEFT JOIN alunos a ON m.aluno_id = a.id
        ORDER BY pg.id DESC";
$res = $conn->query($sql);
?>

<table>
<tr>
    <th>ID</th>
    <th>Aluno</th>
    <th>Matrícula</th>
    <th>Valor</th>
    <th>Data</th>
    <th>Método</th>
    <th>Ações</th>
</tr>

<?php while($row = $res->fetch_assoc()) { ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= htmlspecialchars($row['aluno']) ?></td>
    <td><?= $row['matricula_id'] ?></td>
    <td>R$ <?= number_format($row['valor'], 2, ',', '.') ?></td>
    <td><?= $row['data_pagamento'] ?></td>
    <td><?= htmlspecialchars($row['metodo']) ?></td>
    <td>
        <a href="pagamentos_editar.php?id=<?= $row['id'] ?>">Editar</a> |
        <a href="pagamentos_excluir.php?id=<?= $row['id'] ?>" onclick="return confirm('Excluir pagamento?')">Excluir</a>
    </td>
</tr>
<?php } ?>
</table>

<?php include "../../includes/footer.php"; ?>
