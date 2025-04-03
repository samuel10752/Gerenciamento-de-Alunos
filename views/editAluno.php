<?php
require '../controllers/alunosController.php';

if (isset($_GET['edit_id'])) {
    $editAluno = recuperarAluno($conn, $_GET['edit_id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'], $_POST['nome'], $_POST['email'], $_POST['curso'], $_POST['sexo'])) {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $curso = $_POST['curso'];
        $sexo = $_POST['sexo'];

        if (editarAluno($conn, $id, $nome, $email, $curso, $sexo)) {
            header("Location: ../public/index.php?message=Aluno atualizado com sucesso!");
            exit;
        } else {
            echo "Erro ao atualizar aluno.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Aluno</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
    <div class="container">
        <h1>Editar Aluno</h1>
        <?php if ($editAluno): ?>
        <form method="post">
            <input type="hidden" name="id" value="<?= $editAluno['id']; ?>">

            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="<?= $editAluno['nome']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?= $editAluno['email']; ?>" required>

            <label for="curso">Curso:</label>
            <input type="text" name="curso" value="<?= $editAluno['curso']; ?>" required>

            <label for="sexo">Sexo:</label>
            <select name="sexo" required>
                <option value="masculino" <?= $editAluno['sexo'] === 'masculino' ? 'selected' : ''; ?>>Masculino</option>
                <option value="feminino" <?= $editAluno['sexo'] === 'feminino' ? 'selected' : ''; ?>>Feminino</option>
            </select>

            <button  class="edit_aluno" type="submit">Salvar</button>
        </form>
        <a href="../public/index.php" class="button">Voltar</a>
        <?php endif; ?>
    </div>
</body>
</html>
