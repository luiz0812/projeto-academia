<?php
include_once __DIR__ . '/../includes/conexao.php';
include_once __DIR__ . '/../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $preco = floatval(str_replace(',', '.', $_POST['preco'] ?? 0));
    $duracao = intval($_POST['duracao_meses'] ?? 1);

    if ($nome === '') {
        echo "<div class='flash error'>Nome obrigatório.</div>";
    } else {
        $stmt = $conn->prepare("INSERT INTO planos (nome, descricao, preco, duracao_meses) VALUES (?,?,?,?)");
        $stmt->bind_param("ssdi", $nome, $descricao, $preco, $duracao);
        if ($stmt->execute()) {
            flash('success','Plano criado.');
            header('Location: listar.php'); exit;
        } else {
            echo "<div class='flash error'>Erro: " . htmlspecialchars($stmt->error) . "</div>";
        }
    }
}
?>

<h2>Cadastrar Plano</h2>
<form method="post">
  <div class="form-row"><label>Nome *</label><input type="text" name="nome" required></div>
  <div class="form-row"><label>Descrição</label><textarea name="descricao"></textarea></div>
  <div class="form-row"><label>Preço (use ponto ou vírgula)</label><input type="text" name="preco" value="0.00"></div>
  <div class="form-row"><label>Duração (meses)</label><input type="number" name="duracao_meses" value="1" min="1"></div>
  <input type="submit" value="Salvar">
  <a href="listar.php" class="button" style="background:#777;margin-left:8px">Cancelar</a>
</form>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
