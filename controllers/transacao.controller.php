<?php
    require_once('database/Connection.php');
    require_once('models/TransacaoModel.php');

    $conn = Connection::getConnection();
    $mensagem_erro = '';
    $transacoes = findAllGroupByMonth($conn);

    switch($acao) {
        case "salvar": $mensagem_erro = save($conn);break;
        case "deletar": deleteById($conn, $_POST['transacaoId']);break;
    }

    function findAllGroupByMonth($conn) {
        $query = $conn->prepare('SELECT * FROM transacao ORDER BY data_transacao DESC');
        $query->execute();
        $transacoes = $query->fetchAll(PDO::FETCH_CLASS, 'TransacaoModel');

        $transacoesPorMes = [];
        foreach ($transacoes as $transacao) {
            $month = date("Y-m", strtotime($transacao->getDataTransacao()));
            $transacoesPorMes[$month][] = $transacao;
        }

        return $transacoesPorMes;

    }

    function save($conn){

        $descricao = $_POST['descricao'];
        $valor = (int) $_POST['valor'];
        $tipo = $_POST['tipo'];
        $data_transacao = $_POST['data_transacao'];

        if(empty($descricao)) {
            return 'Insira uma descricao';
        }

        if($valor === 0) {
            return 'Valor não pode ser 0';
        }

        if($tipo !== 'entrada' && $tipo !== 'saida') {
            return 'Tipo inválido';
        }

        if($data_transacao === ''){
            return 'Insira uma data';
        }

        

        $query = $conn->prepare('INSERT INTO transacao(descricao, valor, tipo, data_transacao) VALUES (:descricao, :valor, :tipo, :data_transacao)');
        $query->bindParam(':descricao', $descricao);
        $query->bindParam(':valor', $valor);
        $query->bindParam(':tipo',  $tipo);
        $query->bindParam(':data_transacao', $data_transacao);

        $query->execute();
        header('Location: ' . BASE_URL . '/transacao/listar');
    }

    function deleteById($conn, $transacaoId){

        $query = $conn->prepare('DELETE FROM transacao WHERE transacao_id = :transacao_id');
        $query->bindParam(':transacao_id', $transacaoId);
        $query->execute();

        header('Location: ' . BASE_URL . '/transacao/listar');
    }

    require_once('views.php');