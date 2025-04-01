<?php

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $sql = "DELETE FROM alunos WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro deletado com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>