<?php

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $curso = $_POST['curso'];
    $sexo = $_POST['sexo'];

    $sql = "UPDATE alunos SET nome='$nome', email='$email', curso='$curso', sexo='$sexo' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro atualizado com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>