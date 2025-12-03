<?php 
include "../includes/header.php";

$sql = "SELECT m.*, a.nome AS aluno_nome 
        FROM matriculas m
        JOIN alunos a ON m.aluno_id = a.id
        ORDER BY m.id DESC";
$result = $conn->query($sql);
?>

<h2>Lista de Matrículas</h2>
<a href="cadastrar.php">+ Nova Matrícula</a>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Aluno</th>
        <th>Plano</th>
        <th>Data</th>
        <th>Status</th>
        <th>Ações</th>
    </tr>

    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['aluno_nome'] ?></td>
        <td><?= $row['plano'] ?></td>
        <td><?= $row['data_matricula'] ?></td>
        <td><?= $row['status'] ?></td>
        <td>
            <a href="editar.php?id=<?= $row['id'] ?>">Editar</a> |
            <a href="excluir.php?id=<?= $row['id'] ?>">Excluir</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include "../includes/footer.php"; ?>
