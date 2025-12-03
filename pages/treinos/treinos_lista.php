<?php
include_once __DIR__ . '/../includes/conexao.php';
include_once __DIR__ . '/../includes/header.php';

$sql = "SELECT t.*, a.nome AS aluno_nome FROM treinos t JOIN alunos a ON t.aluno_id = a.id ORDER BY t.id DESC";
$res = $conn->query($sql);
?>
<h2>Treinos <a class="button" href="cadastrar.php" style="float:right">+ Novo</a></h2>

<table>
  <thead><tr><th>ID</th><th>Aluno</th><th>Título</th><th>Dia</th><th>Criado em</th><th>Ações</th></tr></thead>
  <tbody>
  <?php while($r = $res->fetch_assoc()): ?>
    <tr>
      <td><?= $r['id'] ?></td>
      <td><?= htmlspecialchars($r['aluno_nome']) ?></td>
      <td><?= htmlspecialchars($r['titulo']) ?></td>
      <td><?= htmlspecialchars($r['dia_semana']) ?></td>
      <td><?= $r['criado_em'] ?></td>
      <td>
        <a href="editar.php?id=<?= $r['id'] ?>">Editar</a> |
        <a href="excluir.php?id=<?= $r['id'] ?>" onclick="return confirm('Excluir este treino?')">Excluir</a>
      </td>
    </tr>
  <?php endwhile; ?>
  </tbody>
</table>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
