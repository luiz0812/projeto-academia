<?php 
include "../includes/header.php";

$sql = "SELECT p.*, m.plano, a.nome AS aluno_nome
        FROM pagamentos p
        JOIN matriculas m ON p.matricula_id = m.id
        JOIN alunos a ON m.aluno_id = a.id
        ORDER BY p.id DESC";

$result = $conn->query($sql);
?>

<h2>Lista de Pagamentos</h2>
<a href="cadastrar.php">+ Registrar Pagamento</a>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Aluno</th>
        <th>Plano</th>
        <th>Valor</th>
        <th>Data</th>
        <th>Método</th>
        <th>Status</th>
        <th>Ações</th>
    </tr>

    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['aluno_nome'] ?></td>
        <td><?= $row['plano'] ?></td>
        <td>R$ <?= $row['valor'] ?></td>
        <td><?= $row['data_pagamento'] ?></td>
        <td><?= $row['metodo'] ?></td>
        <td><?= $row['status'] ?></td>
        <td>
            <a href="editar.php?id=<?= $row['id'] ?>">Editar</a> |
            <a href="excluir.php?id=<?= $row['id'] ?>">Excluir</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include "../includes/footer.php"; ?>
