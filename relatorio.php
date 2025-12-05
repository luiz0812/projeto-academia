<?php
// relatorios.php
// Coloque na raiz do projeto (ex: C:\xampp\htdocs\projeto-academia\relatorios.php)

include "includes/conexao.php";

// include header se existir, senão imprime um header mínimo
if (file_exists("includes/header.php")) {
    include "includes/header.php";
} else {
    echo '<!doctype html><html><head><meta charset="utf-8"><title>Relatórios</title><link rel="stylesheet" href="style.css"></head><body>';
}

function detectCol($conn, $tabela, $possiveis) {
    $lista = "'" . implode("','", $possiveis) . "'";
    $sql = "
        SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_NAME = ?
        AND COLUMN_NAME IN ($lista)
        LIMIT 1
    ";
    // prepare to avoid issues with older mysqli settings
    $stmt = $conn->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = ? AND COLUMN_NAME IN ($lista) LIMIT 1");
    if (!$stmt) return null;
    $stmt->bind_param("s", $tabela);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res && $r = $res->fetch_assoc()) return $r['COLUMN_NAME'];
    return null;
}

// safety: ensure $conn is valid
if (!isset($conn) || $conn->connect_error) {
    echo "<div class='container'><h1>Relatórios</h1><p>Erro na conexão com o banco.</p></div>";
    if (file_exists("includes/footer.php")) include "includes/footer.php"; else echo "</body></html>";
    exit;
}
?>

<div class="container">
    <h1>Relatório Geral</h1>
    <p>Abaixo: lista de tabelas do banco e os dados principais dos módulos.</p>
    <hr>

    <!-- ========== LISTA TABELAS ========== -->
    <h2>Listagem de tabelas no banco</h2>
    <?php
    $tablesRes = $conn->query("SHOW TABLES");
    if ($tablesRes && $tablesRes->num_rows > 0) {
        echo '<ul class="table-list">';
        while ($row = $tablesRes->fetch_row()) {
            echo '<li>' . htmlspecialchars($row[0]) . '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>Nenhuma tabela encontrada ou erro ao listar tabelas.</p>';
    }
    ?>
    <hr>

    <!-- ========== ALUNOS ========== -->
    <h2>Alunos</h2>
    <?php
    $alunos = $conn->query("SELECT * FROM alunos ORDER BY nome");
    if ($alunos && $alunos->num_rows > 0) {
        echo '<table class="tabela-rel"><tr><th>ID</th><th>Nome</th><th>Telefone</th><th>Email</th></tr>';
        while ($a = $alunos->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($a['id'] ?? '') . '</td>';
            echo '<td>' . htmlspecialchars($a['nome'] ?? '') . '</td>';
            echo '<td>' . htmlspecialchars($a['telefone'] ?? '') . '</td>';
            echo '<td>' . htmlspecialchars($a['email'] ?? '') . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>Sem registros na tabela <strong>alunos</strong>.</p>';
    }
    ?>
    <hr>

    <!-- ========== TREINOS ========== -->
    <h2>Treinos</h2>
    <?php
    $colAlunoTreino = detectCol($conn, "treinos", ["id_aluno","aluno_id","idAluno","aluno"]);
    if ($colAlunoTreino) {
        $sqlTreinos = "SELECT treinos.*, alunos.nome AS aluno FROM treinos LEFT JOIN alunos ON alunos.id = treinos.`$colAlunoTreino`";
    } else {
        $sqlTreinos = "SELECT *, '—' AS aluno FROM treinos";
    }
    $treinos = $conn->query($sqlTreinos);
    if ($treinos && $treinos->num_rows > 0) {
        echo '<table class="tabela-rel"><tr><th>ID</th><th>Aluno</th><th>Descrição</th><th>Categoria</th></tr>';
        while ($t = $treinos->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($t['id'] ?? '') . '</td>';
            echo '<td>' . htmlspecialchars($t['aluno'] ?? '—') . '</td>';
            echo '<td>' . htmlspecialchars($t['descricao'] ?? '') . '</td>';
            echo '<td>' . htmlspecialchars($t['categoria'] ?? '') . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>Sem registros na tabela <strong>treinos</strong>.</p>';
    }
    ?>
    <hr>

    <!-- ========== MATRÍCULAS ========== -->
    <h2>Matrículas</h2>
    <?php
    $colAlunoMat   = detectCol($conn, "matriculas", ["id_aluno","aluno_id","idAluno"]);
    $colPlanoMat   = detectCol($conn, "matriculas", ["id_plano","plano_id","idPlano"]);
    $colDataMat    = detectCol($conn, "matriculas", ["data","data_matricula","dataMatricula"]);
    $colStatusMat  = detectCol($conn, "matriculas", ["status","situacao"]);

    // monta SQL com cuidados se as colunas forem nulas
    $joinAluno = $colAlunoMat ? "LEFT JOIN alunos ON alunos.id = matriculas.`$colAlunoMat`" : "";
    $joinPlano = $colPlanoMat ? "LEFT JOIN planos ON planos.id = matriculas.`$colPlanoMat`" : "";

    $sqlMat = "SELECT matriculas.*" . ($colAlunoMat ? ", alunos.nome AS aluno" : ", '—' AS aluno") . ($colPlanoMat ? ", planos.nome AS plano" : ", '—' AS plano") . " FROM matriculas $joinAluno $joinPlano";

    $matriculas = $conn->query($sqlMat);
    if ($matriculas && $matriculas->num_rows > 0) {
        echo '<table class="tabela-rel"><tr><th>ID</th><th>Aluno</th><th>Plano</th><th>Status</th><th>Data</th></tr>';
        while ($m = $matriculas->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($m['id'] ?? '') . '</td>';
            echo '<td>' . htmlspecialchars($m['aluno'] ?? '—') . '</td>';
            echo '<td>' . htmlspecialchars($m['plano'] ?? '—') . '</td>';
            echo '<td>' . htmlspecialchars($colStatusMat && isset($m[$colStatusMat]) ? $m[$colStatusMat] : ($m['status'] ?? '—')) . '</td>';
            echo '<td>' . htmlspecialchars($colDataMat && isset($m[$colDataMat]) ? $m[$colDataMat] : ($m['data'] ?? '—')) . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>Sem registros na tabela <strong>matriculas</strong>.</p>';
    }
    ?>
    <hr>

    <!-- ========== PLANOS ========== -->
    <h2>Planos</h2>
    <?php
    $colDuracao = detectCol($conn, "planos", ["duracao","dias","periodo","tempo","validade","qtd_dias"]);
    $planos = $conn->query("SELECT * FROM planos ORDER BY nome");
    if ($planos && $planos->num_rows > 0) {
        echo '<table class="tabela-rel"><tr><th>ID</th><th>Nome</th><th>Valor</th><th>Duração</th></tr>';
        while ($p = $planos->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($p['id'] ?? '') . '</td>';
            echo '<td>' . htmlspecialchars($p['nome'] ?? '') . '</td>';
            echo '<td>R$ ' . (isset($p['valor']) ? number_format($p['valor'], 2, ',', '.') : '0,00') . '</td>';
            echo '<td>' . ($colDuracao && isset($p[$colDuracao]) ? htmlspecialchars($p[$colDuracao]) . ' dias' : '—') . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>Sem registros na tabela <strong>planos</strong>.</p>';
    }
    ?>
    <hr>

    <!-- ========== PAGAMENTOS ========== -->
    <h2>Pagamentos</h2>
    <?php
    $colAlunoPag = detectCol($conn, "pagamentos", ["id_aluno","aluno_id","idAluno","cliente_id","id_cliente"]);
    if ($colAlunoPag) {
        $sqlPag = "SELECT pagamentos.*, alunos.nome AS aluno FROM pagamentos LEFT JOIN alunos ON alunos.id = pagamentos.`$colAlunoPag`";
    } else {
        $sqlPag = "SELECT *, '—' AS aluno FROM pagamentos";
    }
    $pagamentos = $conn->query($sqlPag);
    if ($pagamentos && $pagamentos->num_rows > 0) {
        echo '<table class="tabela-rel"><tr><th>ID</th><th>Aluno</th><th>Valor</th><th>Data</th><th>Status</th></tr>';
        while ($pg = $pagamentos->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($pg['id'] ?? '') . '</td>';
            echo '<td>' . htmlspecialchars($pg['aluno'] ?? '—') . '</td>';
            echo '<td>R$ ' . (isset($pg['valor']) ? number_format($pg['valor'], 2, ',', '.') : '0,00') . '</td>';
            echo '<td>' . htmlspecialchars($pg['data_pagamento'] ?? $pg['data'] ?? '—') . '</td>';
            echo '<td>' . htmlspecialchars($pg['status'] ?? '—') . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>Sem registros na tabela <strong>pagamentos</strong>.</p>';
    }
    ?>

</div>

<?php
if (file_exists("includes/footer.php")) include "includes/footer.php";
else echo "</body></html>";
?>
