<?php
include_once __DIR__ . '/../includes/conexao.php';
include_once __DIR__ . '/../includes/header.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) { flash('error','Plano inválido.'); header('Location:listar.php'); exit; }

$stmt = $conn->prepare("SELECT * FROM planos WHERE id = ?");
$stmt->bind_param("i",$id); $stmt->execute(); $res = $stmt->get_result();
$plano = $res->fetch_assoc();
if (!$plano) { flash('error','Plano não encontrado.'); header('Location:listar.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $preco = floatval(str_replace(',', '.', $_POST['preco'] ?? 0));
    $duracao = intval($_POST['duracao_meses'] ?? 1);

    if ($nome === '') {
        echo "<div class='flash error'>Nome obrigatório.</div>";
    } else {
        $up = $conn->prepare("UPDATE planos SET nome=?, descricao=?, preco=?, duracao_meses=? WHERE id=?");
        $up->bind_param("ssdii",$nome,$descricao,$preco,$duracao,$id);
        if ($up->execute()) { flash('success','Plano atualizado.'); header('Location:listar.php'); exit; }
        else echo "<div class='flash error'>Erro: ".htmlspecialchars($up->error)."</div>";
    }
}
?>

<h2>Editar Plano</h2>
<form method="post">
  <div class="form-row"><label>Nome *</label><input type="text" name="nome" value="<?= htmlspecialchars($plano['nome']) ?>" required></div>
  <div class="form-row"><label>Descrição</label><textarea name="descricao"><?= htmlspecialchars($plano['descricao']) ?></textarea></div>
  <div class="form-row"><label>Preço</label><input type="text" name="preco" value="<?= htmlspecialchars($plano['preco']) ?>"></div>
  <div class="form-row"><label>Duração (meses)</label><input type="number" name="duracao_meses" value="<?= $plano['duracao_meses'] ?>" min="1"></div>
  <input type="submit" value="Salvar">
  <a href="listar.php" class="button" style="background:#777;margin-left:8px">Cancelar</a>
</form>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
