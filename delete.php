<?php require 'alunosController.php'; ?>
<?php
if (isset($_POST['delete_id'])) {
    deletarAluno($conn, $_POST['delete_id']);
    header("Location: index.php");
    exit;
}
?>