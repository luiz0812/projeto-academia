<a href="../../index.php" class="btn-voltar">⬅ Voltar</a>
<?php
include "../../includes/sessao.php";
include "../../includes/conexao.php";
include "../../includes/header.php";
$res = $conn->query("SELECT * FROM treinos ORDER BY id DESC");
?>
<div class="container">
    <h2>Treinos</h2>
    <a href="treinos_cadastro.php"><button>+ Novo Treino</button></a>
    <div class="table-wrap">
    <table>
        <tr><th>ID</th><th>Nome</th><th>Descrição</th><th>Ações</th></tr>
        <?php while($r = $res->fetch_assoc()){ ?>
        <tr>
            <td><?= $r['id'] ?></td>
            <td><?= htmlspecialchars($r['nome']) ?></td>
            <td><?= nl2br(htmlspecialchars($r['descricao'])) ?></td>
            <td class="actions">
                <a href="treinos_editar.php?id=<?= $r['id'] ?>">Editar</a>
                <a class="delete" href="treinos_excluir.php?id=<?= $r['id'] ?>" onclick="return confirm('Excluir?')">Excluir</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    </div>
</div>
<?php include "../../includes/footer.php"; ?>
