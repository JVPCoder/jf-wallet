<?php
require_once('database/Connection.php');
require_once('models/AtivoModel.php');

$conn = Connection::getConnection();
$mensagem_erro = '';
$ativos = findAll($conn); // Ação de listagem de ativos

switch($acao) {
    case "salvar": $mensagem_erro = save($conn);break;
    case "deletar": deleteById($conn, $_POST['ativoId']);break;
}

function findAll($conn)
{
    $query = $conn->prepare('SELECT * FROM ativo ORDER BY data_compra DESC');
    $query->execute();
    $ativos = $query->fetchAll(PDO::FETCH_CLASS, 'AtivoModel');
    return $ativos;
}

function save($conn)
{
    // Coleta os dados enviados pelo formulário
    $nome = $_POST['nome'];
    $quantidade = (int) $_POST['quantidade'];
    $preco_compra = (float) $_POST['preco_cota']; // Atualize com o nome correto da variável
    $data_compra = $_POST['data_compra']; // Deveria estar no formato YYYY-MM-DD
    $dy = (float) $_POST['dy'];
    $ultimo_dividendo = isset($_POST['ultimo_dividendo']) ? (float) $_POST['ultimo_dividendo'] : null; // Caso não seja enviado, trata como NULL
    $data_dividendo = isset($_POST['data_dividendo']) ? $_POST['data_dividendo'] : null; // Caso não seja enviado, trata como NULL

    // Validações básicas
    if (empty($nome)) {
        return 'O nome do ativo é obrigatório.';
    }

    if ($quantidade <= 0) {
        return 'A quantidade deve ser maior que 0.';
    }

    if ($preco_compra <= 0) {
        return 'O preço de compra deve ser maior que 0.';
    }

    if (empty($data_compra)) {
        return 'A data de compra é obrigatória.';
    }

    // Verificar o formato da data, pode ser necessário ajustá-lo aqui
    if (strtotime($data_compra) === false) {
        return 'A data de compra está no formato inválido.';
    }

    // Prepara a consulta para salvar o ativo
    $query = $conn->prepare(
        'INSERT INTO ativo (nome, quantidade, preco_compra, data_compra, dy, ultimo_dividendo, data_dividendo)
         VALUES (:nome, :quantidade, :preco_compra, :data_compra, :dy, :ultimo_dividendo, :data_dividendo)'
    );

    // Faz o bind dos parâmetros
    $query->bindParam(':nome', $nome);
    $query->bindParam(':quantidade', $quantidade);
    $query->bindParam(':preco_compra', $preco_compra);
    $query->bindParam(':data_compra', $data_compra);  // Bind da data de compra
    $query->bindParam(':dy', $dy);
    $query->bindParam(':ultimo_dividendo', $ultimo_dividendo, PDO::PARAM_STR); // PDO::PARAM_STR vai funcionar para NULL também
    $query->bindParam(':data_dividendo', $data_dividendo, PDO::PARAM_STR); // PDO::PARAM_STR vai funcionar para NULL também

    // Executa a consulta
    $query->execute();

    // Redireciona para a listagem de ativos após salvar
    header('Location: ' . BASE_URL . '/ativo/listar');
    exit(); // Certifique-se de parar a execução após o redirecionamento
}

function deleteById($conn, $ativoId)
{
    // Prepara a consulta para excluir o ativo
    $query = $conn->prepare('DELETE FROM ativo WHERE ativo_id = :ativo_id');
    $query->bindParam(':ativo_id', $ativoId, PDO::PARAM_INT);  // Certifique-se de usar o tipo correto (PDO::PARAM_INT)

    // Executa a consulta
    if ($query->execute()) {
        // Redireciona para a listagem de ativos após excluir
        header('Location: ' . BASE_URL . '/ativo/listar');
        exit(); // Para garantir que o script pare após o redirecionamento
    } else {
        return 'Erro ao excluir o ativo.';
    }
}

require_once('views.php');
