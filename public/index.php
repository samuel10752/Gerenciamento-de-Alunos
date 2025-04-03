<?php
require '../controllers/alunosController.php';

$alunos = listarAlunos($conn);
$message = isset($_GET['message']) ? $_GET['message'] : '';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Lista de Alunos</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>Relação de Alunos</h1>
        <a href="../views/addAluno.php" class="button">Adicionar Aluno</a>
        <?php if ($message): ?>
            <div class="message"><?= $message ?></div>
        <?php endif; ?>
        <table>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Curso</th>
                <th>Sexo</th>
                <th>Ações</th>
            </tr>
            <?php while ($row = $alunos->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['nome']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['curso']; ?></td>
                    <td><?= $row['sexo']; ?></td>
                    <td class="actions">
                        <!-- Botão de Editar -->
                        <a href="../views/editAluno.php?edit_id=<?= $row['id']; ?>" class="edit">Editar</a>

                        <!-- Botão de Ver Detalhes -->
                        <a href="../views/viewAluno.php?view_id=<?= $row['id']; ?>" class="details">Ver Detalhes</a>

                        <!-- Botão de Deletar -->
                        <a href="../views/deleteAluno.php?delete_id=<?= $row['id']; ?>" class="delete" onclick="return confirm('Tem certeza que deseja deletar este aluno?');">Deletar</a>
                    </td>

                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>

</html>