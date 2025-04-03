<?php
require 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Captura os dados do formulário
    $nome = $_POST['add_nome'];
    $email = $_POST['add_email'];
    $curso = $_POST['add_curso'];
    $sexo = $_POST['add_sexo'];

    // Insere na tabela alunos
    $sql = "INSERT INTO alunos (nome, email, curso, sexo) VALUES ('$nome', '$email', '$curso', '$sexo')";
    if ($conn->query($sql) === TRUE) {
        $message = "Aluno inserido com sucesso!";
    } else {
        $message = "Erro ao inserir aluno: " . $conn->error;
    }
}
?>
