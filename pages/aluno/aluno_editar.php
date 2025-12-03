<?php
include_once __DIR__ . '/../includes/conexao.php';
include_once __DIR__ . '/../includes/header.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    flash('error','Aluno inválido.');
    header('Location: listar.php');
    exit;
}

// buscar aluno
$stmt = $conn->prepare("SELECT * FROM alunos WHERE id = ?");
$stmt->bind_param("i",$id);
$stmt->execute();
$res = $stmt->get_result();
$aluno = $res->fetch_assoc();
if (!$aluno) {
    flash('error','Aluno não encontrado.');
    header('Location: listar.php');
    exit;
}

$planos_res = $conn->query("SELECT id, nome FROM planos ORDER BY nome");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $data_nasc = $_POST['data_nascimento'] ?? null;
    $plano_id = !empty($_POST['plano_id']) ? intval($_POST['plano_id']) : null;

    if ($nome === '') {
        echo "<div class='flash error'>O nome é obrigatório.</div>";
    } else {
        $up = $conn->prepare("UPDATE alunos SET nome=?, email=?, telefone=?, data_nascimento=?, plano_id=? WHERE id=?");
        $up->bind_param("ssssii", $nome, $email, $telefone, $data_nasc, $plano_id, $id);
        $ok = $up->execute();
        if ($ok) {
            flash('success','Aluno atualizado.');
            header('Location: listar.php');
            exit;
        } else {
            echo "<div class='flash error'>Erro ao atualizar: " . htmlspecialchars($up->error) . "</div>";
        }
    }
}
?>

<h2>Editar Aluno</h2>
<form method="post">
  <div class="form-row"><label>Nome *</label><input type="text" name="nome" value="<?= htmlspecialchars($aluno['nome']) ?>" required></div>
  <div class="form-row"><label>Email</label><input type="email" name="email" value="<?= htmlspecialchars($aluno['email']) ?>"></div>
  <div class="form-row"><label>Telefone</label><input type="text" name="telefone" value="<?= htmlspecialchars($aluno['telefone']) ?>"></div>
  <div class="form-row"><label>Data de Nascimento</label><input type="date" name="data_nascimento" value="<?= htmlspecialchars($aluno['data_nascimento']) ?>"></div>
  <div class="form-row"><label>Plano</label>
    <select name="plano_id">
      <option value="">— Selecionar —</option>
      <?php 
      // reset pointer
      $planos_res->data_seek(0);
      while($p = $planos_res->fetch_assoc()): ?>
        <option value="<?= $p['id'] ?>" <?= ($aluno['plano_id'] == $p['id']) ? 'selected' : '' ?>><?= htmlspecialchars($p['nome']) ?></option>
      <?php endwhile; ?>
    </select>
  </div>
  <input type="submit" value="Salvar">
  <a href="listar.php" class="button" style="background:#777;margin-left:8px">Cancelar</a>
</form>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
