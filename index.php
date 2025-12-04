<?php include "includes/header.php"; ?>

<section class="home">
    <h2>Bem-vindo ao Sistema da Academia</h2>
    <p>Use o menu para gerenciar alunos, treinos, planos, matrículas e pagamentos.</p>

    <div class="cards">
        <a class="card" href="pages/aluno/aluno_lista.php">
            <h3>Alunos</h3>
            <p>Gerencie os alunos cadastrados</p>
        </a>

        <a class="card" href="pages/treinos/treinos_lista.php">
            <h3>Treinos</h3>
            <p>Gerencie treinos e descrições</p>
        </a>

        <a class="card" href="pages/planos/planos_lista.php">
            <h3>Planos</h3>
            <p>Cadastre e gerencie planos</p>
        </a>

        <a class="card" href="pages/matriculas/matriculas_lista.php">
            <h3>Matrículas</h3>
            <p>Matricule alunos em planos</p>
        </a>

        <a class="card" href="pages/pagamentos/pagamentos_lista.php">
            <h3>Pagamentos</h3>
            <p>Registre pagamentos de matrículas</p>
        </a>
    </div>
</section>

<?php include "includes/footer.php"; ?>
