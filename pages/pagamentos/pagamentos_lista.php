<?php
session_start();
include '../includes/sessao.php';
include '../includes/conexao.php';

// Mensagens
if (isset($_SESSION['msg'])) {
    echo "<p>{$_SESSION['msg']}</p>";
    unset($_SESSION['msg']);
}

$sql = "SELECT p.*, a.nome AS aluno 
        FROM pagamento p
        JOIN aluno a ON a.id_aluno = p.id_aluno
        ORDER BY p.id_pagamento DESC";
$query = $conn->query($sql);
?>

<h2>Pagamentos</h2>
<a href="pagamento_add.php">+ Registrar Pagamento</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Aluno</th>
        <th>Valor</th>
        <th>Data</th>
        <th>Status</th>
        <th>Ações</th>
    </tr>

    <?php while ($p = $query->fetch_assoc()) { ?>
        <tr>
            <td><?= $p['id_pagamento'] ?></td>
            <td><?= $p['aluno'] ?></td>
            <td>R$ <?= number_format($p['valor'], 2, ',', '.') ?></td>
            <td><?= $p['data_pagamento'] ?></td>
            <td><?= $p['status'] ?></td>
            <td>
                <a href="pagamento_edit.php?id=<?= $p['id_pagamento'] ?>">Editar</a>
                <a onclick="return confirm('Excluir pagamento?')" 
                   href="pagamento_delete.php?id=<?= $p['id_pagamento'] ?>">Excluir</a>
            </td>
        </tr>
    <?php } ?>
</table>
