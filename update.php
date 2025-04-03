<?php require 'alunosController.php'; ?>
<?php
if (isset($_GET['edit_id'])) {
    $editAluno = recuperarAluno($conn, $_GET['edit_id']);
}
?>
<h2>Editar Aluno</h2>
<form method="post" action="index.php">
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
    
    <button type="submit" name="submit">Salvar Alterações</button>
</form>