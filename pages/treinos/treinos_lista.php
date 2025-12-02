<?php
session_start();
include '../includes/sessao.php';
include '../includes/conexao.php';

// Exibir mensagens
if (isset($_SESSION['msg'])) {
    echo "<p>{$_SESSION['msg']}</p>";
    unset($_SESSION['msg']);
}

$sql = "SELECT * FROM treino ORDER BY id_treino DESC";
$query = $conn->query($sql);
?>

<h2>Treinos</h2>
<a href="treino_add.php">+ Adicionar Treino</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Carga</th>
        <th>Ações</th>
    </tr>

    <?php while ($t = $query->fetch_assoc()) { ?>
        <tr>
            <td><?= $t['id_treino'] ?></td>
            <td><?= $t['nome_treino'] ?></td>
            <td><?= $t['carga'] ?></td>
            <td>
                <a href="treino_edit.php?id=<?= $t['id_treino'] ?>">Editar</a>
                <a onclick="return confirm('Excluir treino?')" 
                   href="treino_delete.php?id=<?= $t['id_treino'] ?>">Excluir</a>
            </td>
        </tr>
    <?php } ?>
</table>
