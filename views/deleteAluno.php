<?php
require '../config/config.php';
require '../controllers/alunosController.php';

if (isset($_GET['delete_id'])) {
    deletarAluno($conn, $_GET['delete_id']);
    header("Location: ../public/index.php?message=Aluno deletado com sucesso!");
    exit;
}
?>
