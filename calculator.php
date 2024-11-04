<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $qtd = isset($_POST['qtd']) ? (int) $_POST['qtd'] : 0;
    $dividend = isset($_POST['dividend']) ? (float) $_POST['dividend'] : 0.0;
    $time = isset($_POST['time']) ? (int) $_POST['time'] : 0;

    if ($qtd > 0 && $dividend > 0 && $time > 0) {
        $totalDividend = $qtd * $dividend * $time;

        echo "<h2 class='text-2xl font-semibold text-gray-700 text-center mb-4'>Resultado da Simulação</h2>";
        echo "<p class='text-center'>Com $qtd papéis/cotas, recebendo R$ " . number_format($dividend, 2, ',', '.') . " de dividendo cada, durante $time meses:</p>";
        echo "<p class='text-center font-bold'>Total de Dividendos (aproximadamente): R$ " . number_format($totalDividend, 2, ',', '.') . "</p>";
    } else {
        echo "<p style='color: red; text-align: center;'>Por favor, preencha todos os campos corretamente.</p>";
    }
} else {
    echo "<p style='text-align: center;'>Acesso inválido. Por favor, utilize o formulário para enviar os dados.</p>";
}
