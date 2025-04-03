<?php
require 'config/config.php';

// Função para adicionar aluno
function adicionarAluno($conn, $nome, $email, $curso, $sexo) {
    $sql = "INSERT INTO alunos (nome, email, curso, sexo) VALUES ('$nome', '$email', '$curso', '$sexo')";
    return $conn->query($sql);
}

// Função para editar aluno
function editarAluno($conn, $id, $nome, $email, $curso, $sexo) {
    $sql = "UPDATE alunos SET nome='$nome', email='$email', curso='$curso', sexo='$sexo' WHERE id=$id";
    return $conn->query($sql);
}

// Função para deletar aluno
function deletarAluno($conn, $id) {
    $sql = "DELETE FROM alunos WHERE id=$id";
    return $conn->query($sql);
}

// Função para recuperar aluno por ID
function recuperarAluno($conn, $id) {
    $sql = "SELECT * FROM alunos WHERE id=$id";
    return $conn->query($sql)->fetch_assoc();
}

// Função para listar todos os alunos
function listarAlunos($conn) {
    $sql = "SELECT * FROM alunos";
    return $conn->query($sql);
}
?>