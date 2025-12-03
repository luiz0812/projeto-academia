<?php
include_once __DIR__ . '/../includes/conexao.php';
include_once __DIR__ . '/../includes/header.php';

// buscar planos para select
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
        $stmt = $conn->prepare("INSERT INTO alunos (nome,email,telefone,data_nascimento,plano_id) VALUES (?,?,?,?,?)");
        $stmt->bind_param("ssssi", $nome, $email, $telefone, $data_nasc, $plano_id);
        $ok = $stmt->execute();
        if ($ok) {
            flash('success', 'Aluno cadastrado com sucesso.');
            header('Location: listar.php');
            exit;
        } else {
            echo "<div class='flash error'>Erro ao cadastrar: " . htmlspecialchars($stmt->error) . "</div>";
        }
    }
}
?>

<h2>Cadastrar Aluno</h2>
<form method="post">
  <div class="form-row">
    <label>Nome *</label>
    <input type="text" name="nome" required>
  </div>
  <div class="form-row">
    <label>Email</label>
    <input type="email" name="email">
  </div>
  <div class="form-row">
    <label>Telefone</label>
    <input type="text" name="telefone">
  </div>
  <div class="form-row">
    <label>Data de Nascimento</label>
    <input type="date" name="data_nascimento">
  </div>
  <div class="form-row">
    <label>Plano</label>
    <select name="plano_id">
      <option value="">— Selecionar —</option>
      <?php while($p = $planos_res->fetch_assoc()): ?>
        <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nome']) ?></option>
      <?php endwhile; ?>
    </select>
  </div>
  <input type="submit" value="Salvar">
  <a href="listar.php" class="button" style="background:#777;margin-left:8px">Cancelar</a>
</form>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
