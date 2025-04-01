<?php
require 'config.php';

// Mensagem de feedback
$message = "";

// Processamento de adicionar, editar e deletar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_id'])) {
        // Deletar aluno
        $id = $_POST['delete_id'];
        $sql = "DELETE FROM alunos WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            $message = "Registro deletado com sucesso!";
        } else {
            $message = "Erro ao deletar: " . $conn->error;
        }
    } elseif (isset($_POST['add_nome'], $_POST['add_email'], $_POST['add_curso'], $_POST['add_sexo'])) {
        // Adicionar aluno
        $nome = $_POST['add_nome'];
        $email = $_POST['add_email'];
        $curso = $_POST['add_curso'];
        $sexo = $_POST['add_sexo'];
        $sql = "INSERT INTO alunos (nome, email, curso, sexo) VALUES ('$nome', '$email', '$curso', '$sexo')";
        if ($conn->query($sql) === TRUE) {
            $message = "Aluno inserido com sucesso!";
            // Limpa os campos após adicionar
            $_POST = [];
        } else {
            $message = "Erro ao inserir: " . $conn->error;
        }
    } elseif (isset($_POST['id'], $_POST['nome'], $_POST['email'], $_POST['curso'], $_POST['sexo'])) {
        // Editar aluno
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $curso = $_POST['curso'];
        $sexo = $_POST['sexo'];
        $sql = "UPDATE alunos SET nome='$nome', email='$email', curso='$curso', sexo='$sexo' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            $message = "Registro atualizado com sucesso!";
            // Limpa os campos após editar
            $_POST = [];
        } else {
            $message = "Erro ao atualizar: " . $conn->error;
        }
    }
}

// Recupera os dados do aluno para edição (se 'editar' foi clicado)
$editAluno = null;
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $result = $conn->query("SELECT * FROM alunos WHERE id = $edit_id");
    $editAluno = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Alunos</title>
    <style>
        /* Estilo do sistema */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .message {
            text-align: center;
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
            background-color: #f9f9f9;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input,
        select,
        button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        .actions button {
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .edit {
            background-color: #ffc107;
            color: black;
        }

        .delete {
            background-color: #dc3545;
            color: white;
        }

        .delete:hover {
            background-color: #c82333;
        }
    </style>
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
                <input type="text" name="nome" value="<?= $editAluno['nome']; ?>" required>

                <label for="email">Email:</label>
                <input type="email" name="email" value="<?= $editAluno['email']; ?>" required>

                <label for="curso">Curso:</label>
                <input type="text" name="curso" value="<?= $editAluno['curso']; ?>" required>

                <label for="sexo">Sexo:</label>
                <select name="sexo" required>
                    <option value="masculino" <?= $editAluno['sexo'] == 'masculino' ? 'selected' : ''; ?>>Masculino</option>
                    <option value="feminino" <?= $editAluno['sexo'] == 'feminino' ? 'selected' : ''; ?>>Feminino</option>
                </select>

                <button type="submit">Salvar Alterações</button>
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

                <button type="submit">Adicionar</button>
            </form>
        <?php endif; ?>

        <!-- Tabela de Alunos -->
        <h2>Lista de Alunos</h2>
        <table>
            <tr>
                <th>ID</th>
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
                            <td>{$row['id']}</td>
                            <td>{$row['nome']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['curso']}</td>
                            <td>{$row['sexo']}</td>
                            <td>
                                <a href='?edit_id={$row['id']}' class='edit'>Editar</a>
                                <form method='post' style='display:inline;'>
                                    <input type='hidden' name='delete_id' value='{$row['id']}'>
                                    <button class='delete'>Deletar</button>
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
</