<?php
require '../controllers/alunosController.php';

$erro = ""; // Variável para armazenar erros

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_nome'], $_POST['add_email'], $_POST['add_curso'], $_POST['add_sexo'])) {
        $nome = $_POST['add_nome'];
        $email = $_POST['add_email'];
        $curso = $_POST['add_curso'];
        $sexo = $_POST['add_sexo'];

        // Validação: Permitir apenas letras e espaços
        if (!preg_match("/^[A-Za-zÀ-ÿ\s]+$/", $nome)) {
            $erro = "O campo Nome só pode conter letras e espaços.";
        } elseif (!preg_match("/^[A-Za-zÀ-ÿ\s]+$/", $curso)) {
            $erro = "O campo Curso só pode conter letras e espaços.";
        } else {
            // Verificar se o e-mail já existe
            $sql = "SELECT * FROM alunos WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $erro = "Já existe um aluno cadastrado com este e-mail.";
            } else {
                // Inserir dados no banco
                if (adicionarAluno($conn, $nome, $email, $curso, $sexo)) {
                    header("Location: ../public/index.php?message=Aluno inserido com sucesso!");
                    exit;
                } else {
                    $erro = "Erro ao adicionar aluno.";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Aluno</title>
    <link rel="stylesheet" href="../public/styles.css">
    <script>
        // Validação de entrada: Apenas letras permitidas
        function validarFormulario(event) {
            const nome = document.forms["alunoForm"]["add_nome"].value;
            const curso = document.forms["alunoForm"]["add_curso"].value;

            const regexLetras = /^[A-Za-zÀ-ÿ\s]+$/; // Regex para letras com acentos e espaços

            if (!regexLetras.test(nome)) {
                alert("O campo Nome só pode conter letras e espaços.");
                event.preventDefault(); // Impede o envio
                return false;
            }

            if (!regexLetras.test(curso)) {
                alert("O campo Curso só pode conter letras e espaços.");
                event.preventDefault();
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Adicionar Aluno</h1>
        <!-- Exibir mensagem de erro, se houver -->
        <?php if (!empty($erro)): ?>
            <div class="message error"><?= $erro ?></div>
        <?php endif; ?>

        <!-- Formulário com validação de JavaScript -->
        <form name="alunoForm" method="post" onsubmit="return validarFormulario(event)">
            <label for="add_nome">Nome:</label>
            <input type="text" name="add_nome" required>

            <label for="add_email">Email:</label>
            <input type="email" name="add_email" required>

            <label for="add_curso">Curso:</label>
            <input type="text" name="add_curso" required>

            <label for="add_sexo">Sexo:</label>
            <select name="add_sexo" required>
                <option value="masculino">Masculino</option>
                <option value="feminino">Feminino</option>
            </select>

            <button class="add" type="submit">Adicionar</button>
        </form>

        <a href="../public/index.php" class="button">Voltar</a>
    </div>
</body>
</html>
