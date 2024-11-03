<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Ações - jf-wallet</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100">

    <header class="bg-green-500 text-white p-4">
        <h1 class="text-3xl font-bold text-center">jf-wallet</h1>
        <nav class="mt-2">
            <ul class="flex justify-center space-x-4">
                <li><a href="<?= BASE_URL ?>/index.php?page=dashboard" class="hover:underline">Home</a></li>
                <li><a href="<?= BASE_URL ?>/index.php?page=acoes" class="hover:underline">Ações</a></li>
            </ul>
        </nav>
    </header>

    <div class="bg-white m-auto shadow-md rounded-lg w-full max-w-2xl p-6 mt-6">

        <h2 class="text-2xl font-semibold text-gray-700 text-center mb-4">Listagem de Ações</h2>

        <!-- Tabela de Ações -->
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="border-b px-4 py-2 text-left text-gray-700">Nome</th>
                    <th class="border-b px-4 py-2 text-left text-gray-700">Preço de Compra</th>
                    <th class="border-b px-4 py-2 text-left text-gray-700">Data de Compra</th>
                    <th class="border-b px-4 py-2 text-left text-gray-700">Dividend Yield</th>
                    <th class="border-b px-4 py-2 text-left text-gray-700">Último Dividendo</th>
                    <th class="border-b px-4 py-2 text-left text-gray-700">Data Último Dividendo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Exemplo de dados de ações
                $stocks = [
                    [
                        'name' => 'Ação 1',
                        'purchasePrice' => 100.00,
                        'purchaseDate' => '2024-01-15',
                        'dividendYield' => 3.5,
                        'lastDividend' => 5.00,
                        'dateLastDividend' => '2024-06-30'
                    ],
                    [
                        'name' => 'Ação 2',
                        'purchasePrice' => 200.00,
                        'purchaseDate' => '2023-12-05',
                        'dividendYield' => 4.2,
                        'lastDividend' => 8.50,
                        'dateLastDividend' => '2024-05-20'
                    ],
                    // Outras ações...
                ];

                foreach ($stocks as $stock) {
                    echo "<tr class='border-b'>";
                    echo "<td class='px-4 py-2'>{$stock['name']}</td>";
                    echo "<td class='px-4 py-2'>R$ " . number_format($stock['purchasePrice'], 2, ',', '.') . "</td>";
                    echo "<td class='px-4 py-2'>" . date("d/m/Y", strtotime($stock['purchaseDate'])) . "</td>";
                    echo "<td class='px-4 py-2'>{$stock['dividendYield']}%</td>";
                    echo "<td class='px-4 py-2'>R$ " . number_format($stock['lastDividend'], 2, ',', '.') . "</td>";
                    echo "<td class='px-4 py-2'>" . date("d/m/Y", strtotime($stock['dateLastDividend'])) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Botões para Cadastrar Entradas e Saídas -->
        <div class="flex justify-between mt-6">
            <button onclick="toggleModal()" class="w-1/2 mr-2 bg-green-500 text-white text-center py-2 rounded-lg hover:bg-green-600 transition-colors">
                <i class="fa fa-plus" aria-hidden="true"></i>
                Nova Ação
            </button>

            <button onclick="toggleModal()" class="w-1/2 ml-2 bg-yellow-500 text-white text-center py-2 rounded-lg hover:bg-yellow-600 transition-colors">
                <i class="fa fa-calculator" aria-hidden="true"></i>
                Simulador de Dividendo
            </button>
        </div>
    </div>

</body>

</html>