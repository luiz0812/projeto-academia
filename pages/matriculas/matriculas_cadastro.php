<?php
include "../../includes/sessao.php";
include "../../includes/conexao.php";
include "../../includes/header.php";

$alunos = $conn->query("SELECT id,nome FROM alunos ORDER BY nome");
$planos = $conn->query("SELECT id,nome FROM planos ORDER BY nome");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aluno_id = (int)$_POST['aluno_id'];
    $plano_id = (int)$_POST['plano_id'];
    $data = $conn->real_escape_string($_POST['data_matricula']);
    $status = $conn->real_escape_string($_POST['status']);

    $sql = "INSERT INTO matriculas (aluno_id, plano_id, data_matricula, status) VALUES ($aluno_id,$plano_id,'$data','$status')";
    if ($conn->query($sql)) { echo "<script>location.href='matriculas_lista.php';</script>"; exit; } else { $erro = $conn->error; }
}
?>
<div class="container">
    <h2>Cadastrar Matrícula</h2>
    <?php if(!empty($erro)) echo "<p class='error'>Erro: $erro</p>"; ?>
    <form method="POST">
        <label>Aluno</label>
        <select name="aluno_id" required>
            <option value="">-- selecione --</option>
            <?php while($a=$alunos->fetch_assoc()){ ?>
                <option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['nome']) ?></option>
            <?php } ?>
        </select>

        <label>Plano</label>
        <select name="plano_id" required>
            <option value="">-- selecione --</option>
            <?php while($p=$planos->fetch_assoc()){ ?>
                <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nome']) ?></option>
            <?php } ?>
        </select>

        <label>Data da matrícula</label>
        <input type="date" name="data_matricula" required>

        <label>Status</label>
        <select name="status" required>
            <option value="Ativa">Ativa</option>
            <option value="Inativa">Inativa</option>
        </select>

        <input type="submit" value="Salvar Matrícula">
    </form>
</div>
<?php include "../../includes/footer.php"; ?>
