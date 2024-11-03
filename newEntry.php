<?php
session_start();
require_once 'config/config.php';
require_once 'controllers/EntryController.php';

$entryController = new EntryController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $description = trim($_POST['description']);
    $amount = trim($_POST['amount']);
    $date = trim($_POST['date']);

    // Tenta cadastrar a nova entrada
    $result = $entryController->createEntry($description, $amount, $date);

    // Verifica se o resultado é uma mensagem de erro ou sucesso
    if ($result[0]) {
        // Redireciona para o dashboard com a mensagem de sucesso
        header("Location: dashboard.php?success=" . urlencode($result[1]));

    } else {
        // Redireciona para o dashboard com a mensagem de erro
        header("Location: dashboard.php?error=" . urlencode($result[1]));
    }
    exit();
}
?>
