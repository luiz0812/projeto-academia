<?php
include "../../includes/sessao.php";
include "../../includes/conexao.php";
include "../../includes/header.php";
$sql = "SELECT m.*, a.nome AS aluno, p.nome AS plano FROM matriculas m
        LEFT JOIN alunos a ON m.aluno_id = a.id
        LEFT JOIN planos p ON m.plano_id = p.id
        ORDER BY m.id DESC";
$res = $conn->query($sql);
?>
<div class="container">
    <h2>Matrículas</h2>
    <a href="matriculas_cadastro.php"><button>+ Nova Matrícula</button></a>
    <div class="table-wrap">
    <table>
        <tr><th>ID</th><th>Aluno</th><th>Plano</th><th>Data</th><th>Status</th><th>Ações</th></tr>
        <?php while($r=$res->fetch_assoc()){ ?>
        <tr>
            <td><?= $r['id'] ?></td>
            <td><?= htmlspecialchars($r['aluno']) ?></td>
            <td><?= htmlspecialchars($r['plano']) ?></td>
            <td><?= $r['data_matricula'] ?></td>
            <td><?= htmlspecialchars($r['status']) ?></td>
            <td class="actions">
                <a href="matriculas_editar.php?id=<?= $r['id'] ?>">Editar</a>
                <a class="delete" href="matriculas_excluir.php?id=<?= $r['id'] ?>" onclick="return confirm('Excluir?')">Excluir</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    </div>
</div>
<?php include "../../includes/footer.php"; ?>
