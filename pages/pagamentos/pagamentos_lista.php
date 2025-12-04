<?php
include "../../includes/sessao.php";
include "../../includes/conexao.php";
include "../../includes/header.php";
$sql = "SELECT pg.*, m.id AS matricula_id, a.nome AS aluno FROM pagamentos pg
        LEFT JOIN matriculas m ON pg.matricula_id = m.id
        LEFT JOIN alunos a ON m.aluno_id = a.id
        ORDER BY pg.id DESC";
$res = $conn->query($sql);
?>
<div class="container">
    <h2>Pagamentos</h2>
    <a href="pagamentos_cadastro.php"><button>+ Novo Pagamento</button></a>
    <div class="table-wrap">
    <table>
        <tr><th>ID</th><th>Aluno</th><th>Matrícula</th><th>Valor</th><th>Data</th><th>Status</th><th>Ações</th></tr>
        <?php while($r=$res->fetch_assoc()){ ?>
        <tr>
            <td><?= $r['id'] ?></td>
            <td><?= htmlspecialchars($r['aluno']) ?></td>
            <td><?= $r['matricula_id'] ?></td>
            <td>R$ <?= number_format($r['valor'],2,',','.') ?></td>
            <td><?= $r['data_pagamento'] ?></td>
            <td><?= htmlspecialchars($r['status']) ?></td>
            <td class="actions">
                <a href="pagamentos_editar.php?id=<?= $r['id'] ?>">Editar</a>
                <a class="delete" href="pagamentos_excluir.php?id=<?= $r['id'] ?>" onclick="return confirm('Excluir?')">Excluir</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    </div>
</div>
<?php include "../../includes/footer.php"; ?>
