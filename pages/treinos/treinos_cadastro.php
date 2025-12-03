<?php
include_once __DIR__ . '/../includes/conexao.php';
include_once __DIR__ . '/../includes/header.php';

// buscar alunos para select
$alunos_res = $conn->query("SELECT id, nome FROM alunos ORDER BY nome");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aluno_id = intval($_POST['aluno_id'] ?? 0);
    $titulo = trim($_POST['titulo'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $dia = trim($_POST['dia_semana'] ?? '');

    if ($aluno_id <= 0 || $titulo === '') {
        echo "<div class='flash error'>Aluno e título são obrigatórios.</div>";
    } else {
        $stmt = $conn->prepare("INSERT INTO treinos (aluno_id, titulo, descricao, dia_semana) VALUES (?,?,?,?)");
        $stmt->bind_param("isss", $aluno_id, $titulo, $descricao, $dia);
        if ($stmt->execute()) { flash('success','Treino cadastrado.'); header('Location:listar.php'); exit; }
        else echo "<div class='flash error'>Erro: ".htmlspecialchars($stmt->error)."</div>";
    }
}
?>

<h2>Cadastrar Treino</h2>
<form method="post">
  <div class="form-row"><label>Aluno *</label>
    <select name="aluno_id" required>
      <option value="">— Selecionar —</option>
      <?php while($a = $alunos_res->fetch_assoc()): ?>
        <option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['nome']) ?></option>
      <?php endwhile; ?>
    </select>
  </div>
  <div class="form-row"><label>Título *</label><input type="text" name="titulo" required></div>
  <div class="form-row"><label>Descrição</label><textarea name="descricao"></textarea></div>
  <div class="form-row"><label>Dia da semana</label><input type="text" name="dia_semana" placeholder="Ex: Segunda"></div>
  <input type="submit" value="Salvar">
  <a href="listar.php" class="button" style="background:#777;margin-left:8px">Cancelar</a>
</form>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
