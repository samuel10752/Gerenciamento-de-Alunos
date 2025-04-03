<?php
require 'config/config.php';
require 'alunosController.php';

// Mensagem de feedback
$message = "";

// Processamento do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        // Verifica se é para adicionar ou editar aluno
        if (isset($_POST['add_nome'], $_POST['add_email'], $_POST['add_curso'], $_POST['add_sexo'])) {
            $nome = $_POST['add_nome'];
            $email = $_POST['add_email'];
            $curso = $_POST['add_curso'];
            $sexo = $_POST['add_sexo'];

            if (adicionarAluno($conn, $nome, $email, $curso, $sexo)) {
                $message = "Aluno inserido com sucesso!";
            } else {
                $message = "Erro ao adicionar aluno.";
            }
        } elseif (isset($_POST['id'], $_POST['nome'], $_POST['email'], $_POST['curso'], $_POST['sexo'])) {
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $curso = $_POST['curso'];
            $sexo = $_POST['sexo'];

            if (editarAluno($conn, $id, $nome, $email, $curso, $sexo)) {
                $message = "Aluno atualizado com sucesso!";
            } else {
                $message = "Erro ao atualizar aluno.";
            }
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    // Deletar aluno
    if (isset($_POST['delete_id'])) {
        $id = $_POST['delete_id'];
        if (deletarAluno($conn, $id)) {
            $message = "Aluno deletado com sucesso!";
        } else {
            $message = "Erro ao deletar aluno.";
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Recuperar aluno para edição
$editAluno = null;
if (isset($_GET['edit_id'])) {
    $editAluno = recuperarAluno($conn, $_GET['edit_id']);
}

// Listar alunos
$alunos = listarAlunos($conn);
?>>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Alunos</title>
    <link rel="stylesheet" href="styles.css">

</head>


<body>
    <div class="container">
        <h1>Gerenciamento de Alunos</h1>

        <!-- Exibe mensagem de feedback -->
        <?php if ($message) : ?>
            <div class="message"><?= $message ?></div>
        <?php endif; ?>

        <!-- Formulário de edição (se um aluno está sendo editado) -->
        <?php if ($editAluno): ?>
            <h2>Editar Aluno</h2>
            <form method="post">
                <input type="hidden" name="id" value="<?= $editAluno['id']; ?>">

                <label for="nome">Nome:</label>
                <input type="text" name="nome" value="<?= $editAluno['nome']; ?>" required placeholder="Digite o nome">

                <label for="email">Email:</label>
                <input type="email" name="email" value="<?= $editAluno['email']; ?>" required placeholder="Digite o email">

                <label for="curso">Curso:</label>
                <input type="text" name="curso" value="<?= $editAluno['curso']; ?>" required placeholder="Digite o curso">


                <label for="sexo">Sexo:</label>
                <select name="sexo" required>
                    <option value="masculino" <?= $editAluno['sexo'] === 'masculino' ? 'selected' : ''; ?>>Masculino</option>
                    <option value="feminino" <?= $editAluno['sexo'] === 'feminino' ? 'selected' : ''; ?>>Feminino</option>
                </select>

                <button type="submit" name="submit">Salvar Alterações</button>

            </form>

        <?php else: ?>
            <!-- Formulário de Adição -->
            <h2>Adicionar Aluno</h2>
            <form method="post">
                <label for="add_nome">Nome:</label>
                <input type="text" name="add_nome" required placeholder="Digite o nome">

                <label for="add_email">Email:</label>
                <input type="email" name="add_email" required placeholder="Digite o email">

                <label for="add_curso">Curso:</label>
                <input type="text" name="add_curso" required placeholder="Digite o curso">

                <label for="add_sexo">Sexo:</label>
                <select name="add_sexo" required>
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                </select>

                <button type="submit" name="submit">Adicionar Aluno</button>
            </form>
        <?php endif; ?>

        <!-- Tabela de Alunos -->
        <h2>Lista de Alunos</h2>
        <table>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Curso</th>
                <th>Sexo</th>
                <th>Ações</th>
            </tr>
            <?php
            $sql = "SELECT * FROM alunos";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['nome']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['curso']}</td>
                            <td>{$row['sexo']}</td>

                            <td class='actions'>
                                <!-- Botão de Edztar -->
                                <a href='?edit_id=<?= {$row['id']} ?>' class='edit'>Editar</a>
                                <!-- Botão de Deletar -->
                                <form method='post' style='display:inline;'>
                                    <input type='hidden' name='delete_id' value='<?= {$row['id']} ?>''>
                                    <button type='submit' class='delete'>Deletar</button>
                                </form>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><<td colspan='6'>Nenhum aluno cadastrado.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>