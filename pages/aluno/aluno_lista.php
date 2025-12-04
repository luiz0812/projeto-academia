<?php include "../../includes/header.php"; ?>

<h2>Lista de Alunos</h2>
<a href="aluno_cadastro.php"><button>Cadastrar Novo</button></a>

<?php
$sql = "SELECT * FROM alunos ORDER BY id DESC";
$res = $conn->query($sql);
?>

<table>
<tr>
    <th>ID</th>
    <th>Nome</th>
    <th>Telefone</th>
    <th>Ações</th>
</tr>

<?php while($a = $res->fetch_assoc()) { ?>
<tr>
    <td><?= $a['id'] ?></td>
    <td><?= $a['nome'] ?></td>
    <td><?= $a['telefone'] ?></td>
    <td>
        <a href="aluno_editar.php?id=<?= $a['id'] ?>">Editar</a> |
        <a href="aluno_excluir.php?id=<?= $a['id'] ?>">Excluir</a>
    </td>
</tr>
<?php } ?>
</table>

<?php include "../../includes/footer.php"; ?>
