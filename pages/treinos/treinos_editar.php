<?php
include_once __DIR__ . '/../includes/conexao.php';
include_once __DIR__ . '/../includes/header.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0){ flash('error','Treino inválido.'); header('Location:listar.php'); exit; }

$stmt = $conn->prepare("SELECT * FROM treinos WHERE id = ?");
$stmt->bind_param("i",$id); $stmt->execute(); $res = $stmt->get_result();
$treino = $res->fetch_assoc();
if (!$treino){ flash('error','Treino não encontrado.'); header('Location:listar.php'); exit; }

$alunos_res = $conn->query("SELECT id,nome FROM alunos ORDER BY nome");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aluno_id = intval($_POST['aluno_id'] ?? 0);
    $titulo = trim($_POST['titulo'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $dia = trim($_POST['dia_semana'] ?? '');

    if ($aluno_id <= 0 || $titulo === '') {
        echo "<div class='flash error'>Aluno e título são obrigatórios.</div>";
    } else {
        $up = $conn->prepare("UPDATE treinos SET aluno_id=?, titulo=?, descricao=?, dia_semana=? WHERE id=?");
        $up->bind_param("isssi",$aluno_id,$titulo,$descricao,$dia,$id);
        if ($up->execute()) { flash('success','Treino atualizado.'); header('Location:listar.php'); exit; }
        else echo "<div class='flash error'>Erro: ".htmlspecialchars($up->error)."</div>";
    }
}
?>

<h2>Editar Treino</h2>
<form method="post">
  <div class="form-row"><label>Aluno *</label>
    <select name="aluno_id" required>
      <option value="">— Selecionar —</option>
      <?php while($a = $alunos_res->fetch_assoc()): ?>
        <option value="<?= $a['id'] ?>" <?= ($treino['aluno_id']==$a['id'])?'selected':'' ?>><?= htmlspecialchars($a['nome']) ?></option>
      <?php endwhile; ?>
    </select>
  </div>
  <div class="form-row"><label>Título *</label><input type="text" name="titulo" value="<?= htmlspecialchars($treino['titulo']) ?>" required></div>
  <div class="form-row"><label>Descrição</label><textarea name="descricao"><?= htmlspecialchars($treino['descricao']) ?></textarea></div>
  <div class="form-row"><label>Dia da semana</label><input type="text" name="dia_semana" value="<?= htmlspecialchars($treino['dia_semana']) ?>"></div>
  <input type="submit" value="Salvar">
  <a href="listar.php" class="button" style="background:#777;margin-left:8px">Cancelar</a>
</form>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
