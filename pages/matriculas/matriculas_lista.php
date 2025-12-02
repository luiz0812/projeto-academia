<?php
require "../includes/sessao.php";
require "../includes/conexao.php";

$sql = "SELECT m.id, m.data_matricula, m.status,
               a.nome AS aluno,
               p.nome AS plano
        FROM matricula m
        JOIN aluno a ON m.aluno_id = a.id
        JOIN plano p ON m.plano_id = p.id";

$result = $conn->query($sql);
?>

<h2>Lista de Matrículas</h2>

<table border="1">
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
        <td><?= $row['aluno'] ?></td>
        <td><?= $row['plano'] ?></td>
        <td><?= $row['data_matricula'] ?></td>
        <td><?= $row['status'] ?></td>
        <td>
            <a href="editar-matricula.php?id=<?= $row['id'] ?>">Editar</a>
            <a href="excluir-matricula.php?id=<?= $row['id'] ?>">Excluir</a>
        </td>
    </tr>
<?php endwhile; ?>
</table>
