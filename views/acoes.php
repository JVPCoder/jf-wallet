<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Ações - jf-wallet</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        function toggleModal() {
            const modal = document.getElementById('modal');
            modal.classList.toggle('hidden');
        }

        function toggleCalcModal() {
            const calcmodal = document.getElementById('calcmodal');
            calcmodal.classList.toggle('hidden');
        }

        function submitCalculator(event) {
        event.preventDefault();

        const form = document.querySelector("#calcmodal form");
        const formData = new FormData(form);

        fetch("calculator.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(result => {
            const calcresult = document.getElementById("results");
            calcresult.innerHTML = result;
            calcresult.classList.remove("hidden");
        })
        .catch(error => console.error("Erro:", error));
    }
    </script>
</head>

<body class="bg-gray-100">

    <header class="bg-green-500 text-white p-4">
        <h1 class="text-3xl font-bold text-center"> <i class="fa-solid fa-wallet"></i> J&F Wallet</h1>
        <nav class="mt-2">
            <ul class="flex justify-center space-x-4">
                <li><a href="<?= BASE_URL ?>/index.php?page=dashboard" class="hover:underline">Home</a></li>
                <li><a href="<?= BASE_URL ?>/index.php?page=acoes" class="hover:underline">Ações</a></li>
            </ul>
        </nav>
    </header>

    <div class="bg-white m-auto shadow-md rounded-lg w-full max-w-4xl p-6 mt-6">

        <h2 class="text-2xl font-semibold text-gray-700 text-center mb-4">Listagem de Ações</h2>

        <!-- Tabela de Ações -->
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="border-b px-4 py-2 text-left text-gray-700">Nome</th>
                    <th class="border-b px-4 py-2 text-left text-gray-700">Qtd Cotas</th>
                    <th class="border-b px-4 py-2 text-left text-gray-700">Preço (Cota)</th>
                    <th class="border-b px-4 py-2 text-left text-gray-700">Último Dividendo</th>
                    <th class="border-b px-4 py-2 text-left text-gray-700">Yield (%)</th>
                    <th class="border-b px-4 py-2 text-left text-gray-700">Data de Compra</th>
                    <th class="border-b px-4 py-2 text-left text-gray-700">Data Último Pagamento</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Exemplo de dados de ações
                $stocks = [
                    [
                        'name' => 'KNCR11',
                        'quantity' => 100,
                        'purchasePrice' => 103.23,
                        'purchaseDate' => '2024-01-15',
                        'dividendYield' => 10.01,
                        'lastDividend' => 0.95,
                        'dateLastDividend' => '2024-10-11'
                    ],
                    [
                        'name' => 'HTMX11',
                        'quantity' => 50,
                        'purchasePrice' => 182.53,
                        'purchaseDate' => '2024-09-30',
                        'dividendYield' => 13.34,
                        'lastDividend' => 24.23,
                        'dateLastDividend' => '2024-10-07'
                    ],
                    // Outras ações...
                ];

                foreach ($stocks as $stock) {
                    echo "<tr class='border-b'>";
                    echo "<td class='px-4 py-2'>{$stock['name']}</td>";
                    echo "<td class='px-4 py-2'>{$stock['quantity']}</td>";
                    echo "<td class='px-4 py-2'>R$ " . number_format($stock['purchasePrice'], 2, ',', '.') . "</td>";
                    echo "<td class='px-4 py-2'>R$ " . number_format($stock['lastDividend'], 2, ',', '.') . "</td>";
                    echo "<td class='px-4 py-2'>{$stock['dividendYield']}%</td>";
                    echo "<td class='px-4 py-2'>" . date("d/m/Y", strtotime($stock['purchaseDate'])) . "</td>";
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

            <button onclick="toggleCalcModal()" class="w-1/2 ml-2 bg-yellow-500 text-white text-center py-2 rounded-lg hover:bg-yellow-600 transition-colors">
                <i class="fa fa-calculator" aria-hidden="true"></i>
                Simulador de Dividendo
            </button>
        </div>
    </div>

    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Cadastrar Nova</h2>
            <form action="newEntry.php" method="POST">
                <div class="mb-4">
                    <label for="description" class="block text-gray-700">Título do fundo:</label>
                    <input type="text" id="description" name="description" class="border rounded-lg w-full py-2 px-3 focus:outline-none focus:ring focus:ring-green-300" placeholder="Ex: MXRF11">
                </div>
                <div class="mb-4">
                    <label for="qtd" class="block text-gray-700">Quantidade de papéis/cotas:</label>
                    <input type="number" id="qtd" name="qtd" class="border rounded-lg w-full py-2 px-3 focus:outline-none focus:ring focus:ring-green-300" placeholder="Ex: 100">
                </div>
                <div class="mb-4">
                    <label for="amount" class="block text-gray-700">Preço por cota:</label>
                    <input type="number" id="amount" name="amount" class="border rounded-lg w-full py-2 px-3 focus:outline-none focus:ring focus:ring-green-300" placeholder="Ex: R$9,42">
                </div>
                <div class="mb-4">
                    <label for="dividend" class="block text-gray-700">Valor (R$):</label>
                    <input type="number" id="dividend" name="dividend" class="border rounded-lg w-full py-2 px-3 focus:outline-none focus:ring focus:ring-green-300" placeholder="Ex: R$0,09">
                </div>
                <div class="mb-4">
                    <label for="yield" class="block text-gray-700">Yield (%):</label>
                    <input type="number" id="yield" name="yield" class="border rounded-lg w-full py-2 px-3 focus:outline-none focus:ring focus:ring-green-300" placeholder="Ex: 0,91%">
                </div>
                <div class="mb-4">
                    <label for="buydate" class="block text-gray-700">Data da última compra:</label>
                    <input type="date" id="buydate" name="buydate" class="border rounded-lg w-full py-2 px-3 focus:outline-none focus:ring focus:ring-green-300">
                </div>
                <div class="mb-4">
                    <label for="paydate" class="block text-gray-700">Data do último pagamento:</label>
                    <input type="date" id="paydate" name="paydate" class="border rounded-lg w-full py-2 px-3 focus:outline-none focus:ring focus:ring-green-300">
                </div>
                <div class="flex justify-between mt-6">
                    <button type="button" onclick="toggleModal()" class="bg-gray-300 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-400 transition-colors">
                        Cancelar
                    </button>
                    <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 transition-colors">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="calcmodal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <form onsubmit="submitCalculator(event)" method="POST">
                <div class="mb-4">
                    <label for="qtd" class="block text-gray-700">Quantidade de papéis/cotas:</label>
                    <input type="number" id="qtd" name="qtd" class="border rounded-lg w-full py-2 px-3 focus:outline-none focus:ring focus:ring-green-300" placeholder="Ex: 100">
                </div>
                <div class="mb-4">
                    <label for="dividend" class="block text-gray-700">Último dividendo (R$):</label>
                    <input type="number" id="dividend" step="0.01" name="dividend" class="border rounded-lg w-full py-2 px-3 focus:outline-none focus:ring focus:ring-green-300" placeholder="Ex: R$0,09">
                </div>
                <div class="mb-4">
                    <label for="time" class="block text-gray-700">Período (meses):</label>
                    <input type="number" id="time" name="time" class="border rounded-lg w-full py-2 px-3 focus:outline-none focus:ring focus:ring-green-300" placeholder="Ex: 12">
                </div>
                <div class="flex justify-between mt-6">
                    <button type="button" onclick="toggleCalcModal()" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition-colors">
                        Fechar
                    </button>
                    <button type="submit" onclick="toggleCalcModal()" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 transition-colors">
                        Calcular
                    </button>
                </div>
            </form>
        </div>
    </div>


    <div id="results" class="bg-white m-auto shadow-md rounded-lg w-full max-w-4xl p-6 mt-6 hidden">
        <h2 class="text-2xl font-semibold text-gray-700 text-center mb-4">Resultado da simulação</h2>
        <p>Com X papéis/cotas, recebendo R$ " . number_format($dividend, 2, ',', '.') . " de dividendo cada, durante $time meses:</p>
        <p><strong>Total de Dividendos: R$ " . number_format($totalDividend, 2, ',', '.') . "</strong></p>
    </div>

</body>

</html>
