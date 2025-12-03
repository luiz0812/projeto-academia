<?php
include_once __DIR__ . '/../includes/conexao.php';
include_once __DIR__ . '/../includes/header.php';

$res = $conn->query("SELECT * FROM planos ORDER BY id DESC");
?>
<h2>Planos <a class="button" href="cadastrar.php" style="float:right">+ Novo</a></h2>

<table>
  <thead><tr><th>ID</th><th>Nome</th><th>Preço</th><th>Duração (meses)</th><th>Criado em</th><th>Ações</th></tr></thead>
  <tbody>
  <?php while($r = $res->fetch_assoc()): ?>
    <tr>
      <td><?= $r['id'] ?></td>
      <td><?= htmlspecialchars($r['nome']) ?></td>
      <td>R$ <?= number_format($r['preco'],2,',','.') ?></td>
      <td><?= $r['duracao_meses'] ?></td>
      <td><?= $r['criado_em'] ?></td>
      <td>
        <a href="editar.php?id=<?= $r['id'] ?>">Editar</a> |
        <a href="excluir.php?id=<?= $r['id'] ?>" onclick="return confirm('Excluir este plano?')">Excluir</a>
      </td>
    </tr>
  <?php endwhile; ?>
  </tbody>
</table>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
