<?php
include_once __DIR__ . '/../includes/conexao.php';
include_once __DIR__ . '/../includes/header.php';

// Buscando lista com join para mostrar nome do plano
$sql = "SELECT a.*, p.nome AS plano_nome FROM alunos a LEFT JOIN planos p ON a.plano_id = p.id ORDER BY a.id DESC";
$res = $conn->query($sql);
?>
<h2>Alunos <a class="button" href="cadastrar.php" style="float:right">+ Novo</a></h2>

<table>
  <thead>
    <tr><th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Plano</th><th>Criado em</th><th>Ações</th></tr>
  </thead>
  <tbody>
<?php while($row = $res->fetch_assoc()): ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= htmlspecialchars($row['nome']) ?></td>
      <td><?= htmlspecialchars($row['email']) ?></td>
      <td><?= htmlspecialchars($row['telefone']) ?></td>
      <td><?= htmlspecialchars($row['plano_nome'] ?? '—') ?></td>
      <td><?= $row['criado_em'] ?></td>
      <td>
        <a href="editar.php?id=<?= $row['id'] ?>">Editar</a> |
        <a href="excluir.php?id=<?= $row['id'] ?>" onclick="return confirm('Excluir este aluno?')">Excluir</a>
      </td>
    </tr>
<?php endwhile; ?>
  </tbody>
</table>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
