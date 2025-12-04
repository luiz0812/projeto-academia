<?php
include "../../includes/sessao.php";
include "../../includes/conexao.php";
include "../../includes/header.php";
$res = $conn->query("SELECT * FROM alunos ORDER BY id DESC");
?>
<div class="container">
    <h2>Alunos</h2>
    <a href="aluno_cadastro.php"><button>+ Novo Aluno</button></a>

    <div class="table-wrap">
    <table>
        <tr><th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Ações</th></tr>
        <?php while($r = $res->fetch_assoc()){ ?>
        <tr>
            <td><?= $r['id'] ?></td>
            <td><?= htmlspecialchars($r['nome']) ?></td>
            <td><?= htmlspecialchars($r['email']) ?></td>
            <td><?= htmlspecialchars($r['telefone']) ?></td>
            <td class="actions">
                <a href="aluno_editar.php?id=<?= $r['id'] ?>">Editar</a>
                <a class="delete" href="aluno_excluir.php?id=<?= $r['id'] ?>" onclick="return confirm('Excluir?')">Excluir</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    </div>
</div>
<?php include "../../includes/footer.php"; ?>
