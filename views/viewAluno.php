<?php
require '../config/config.php';
require '../controllers/alunosController.php';

if (isset($_GET['view_id'])) {
    $aluno = recuperarAluno($conn, $_GET['view_id']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Detalhes do Aluno</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
    <div class="container">
        <h1>Detalhes do Aluno</h1>
        <?php if ($aluno): ?>
            <p><strong>Nome:</strong> <?= $aluno['nome']; ?></p>
            <p><strong>Email:</strong> <?= $aluno['email']; ?></p>
            <p><strong>Curso:</strong> <?= $aluno['curso']; ?></p>
            <p><strong>Sexo:</strong> <?= $aluno['sexo']; ?></p>
            <!-- Botão para Voltar -->
            <a href="../public/index.php" class="button">Voltar</a>
        <?php else: ?>
            <p>Aluno não encontrado.</p>
            <a href="../public/index.php" class="button">Voltar</a>
        <?php endif; ?>
    </div>
</body>
</html>
