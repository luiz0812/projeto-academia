<a href="../../index.php" class="btn-voltar">⬅ Voltar</a>
<?php
include "../../includes/sessao.php";
include "../../includes/conexao.php";
include "../../includes/header.php";
$res = $conn->query("SELECT * FROM planos ORDER BY id DESC");
?>
<div class="container">
    <h2>Planos</h2>
    <a href="planos_cadastro.php"><button>+ Novo Plano</button></a>
    <div class="table-wrap">
    <table>
        <tr><th>ID</th><th>Nome</th><th>Valor</th><th>Duração (meses)</th><th>Descrição</th><th>Ações</th></tr>
        <?php while($p=$res->fetch_assoc()){ ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['nome']) ?></td>
            <td>R$ <?= number_format($p['valor'],2,',','.') ?></td>
            <td><?= $p['duracao_meses'] ?></td>
            <td><?= htmlspecialchars($p['descricao']) ?></td>
            <td class="actions">
                <a href="planos_editar.php?id=<?= $p['id'] ?>">Editar</a>
                <a class="delete" href="planos_excluir.php?id=<?= $p['id'] ?>" onclick="return confirm('Excluir?')">Excluir</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    </div>
</div>
<?php include "../../includes/footer.php"; ?>
