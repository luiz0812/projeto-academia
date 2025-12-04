<?php include "../../includes/header.php"; ?>

<h2>Lista de Matrículas</h2>
<a href="matriculas_cadastro.php"><button>Cadastrar Matrícula</button></a>

<?php
$sql = "SELECT m.id, m.data_matricula, m.status, a.nome AS aluno, p.nome AS plano
        FROM matriculas m
        LEFT JOIN alunos a ON m.aluno_id = a.id
        LEFT JOIN planos p ON m.plano_id = p.id
        ORDER BY m.id DESC";
$res = $conn->query($sql);
?>

<table>
<tr>
    <th>ID</th>
    <th>Aluno</th>
    <th>Plano</th>
    <th>Data</th>
    <th>Status</th>
    <th>Ações</th>
</tr>

<?php while($row = $res->fetch_assoc()) { ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= htmlspecialchars($row['aluno']) ?></td>
    <td><?= htmlspecialchars($row['plano']) ?></td>
    <td><?= $row['data_matricula'] ?></td>
    <td><?= htmlspecialchars($row['status']) ?></td>
    <td>
        <a href="matriculas_editar.php?id=<?= $row['id'] ?>">Editar</a> |
        <a href="matriculas_excluir.php?id=<?= $row['id'] ?>" onclick="return confirm('Excluir matrícula?')">Excluir</a>
    </td>
</tr>
<?php } ?>
</table>

<?php include "../../includes/footer.php"; ?>
