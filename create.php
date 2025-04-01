<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $curso = $_POST['curso'];
    $sexo = $_POST['sexo'];

    $sql = "INSERT INTO alunos (nome, email, curso, sexo) VALUES ('$nome', '$email', '$curso', '$sexo')";

    if ($conn->query($sql) === TRUE) {
        echo "Aluno inserido com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>
