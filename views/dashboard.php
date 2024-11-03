<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        function toggleModal() {
            const modal = document.getElementById('modal');
            modal.classList.toggle('hidden');
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center">

    <div class="bg-white shadow-md rounded-lg w-full max-w-md p-6">

        <!-- Mensagem de Erro ou Sucesso -->
        <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <?= htmlspecialchars($_GET['error']); ?>
            </div>
        <?php elseif (isset($_GET['success'])): ?>
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                <?= htmlspecialchars($_GET['success']); ?>
            </div>
        <?php endif; ?>

        <h2 class="text-2xl font-semibold text-gray-700 text-center mb-4">Resumo Mensal de Entradas e Saídas</h2>
        <ul class="mb-2">
            <?php
            // Exemplo de dados de transações
            $transactions = [
                ['description' => 'Salário', 'amount' => 3000.00, 'type' => 'entrada', 'date' => '2024-10-05'],
                ['description' => 'Freelance', 'amount' => 1500.00, 'type' => 'entrada', 'date' => '2024-10-12'],
                ['description' => 'Aluguel', 'amount' => -1000.00, 'type' => 'saida', 'date' => '2024-10-01'],
                ['description' => 'Supermercado', 'amount' => -500.00, 'type' => 'saida', 'date' => '2024-10-10'],
                ['description' => 'Salário', 'amount' => 3000.00, 'type' => 'entrada', 'date' => '2024-11-05'],
                ['description' => 'Transporte', 'amount' => -200.00, 'type' => 'saida', 'date' => '2024-11-08']
            ];

            // Agrupar transações por mês
            $transactionsByMonth = [];
            foreach ($transactions as $transaction) {
                $month = date("Y-m", strtotime($transaction['date']));
                $transactionsByMonth[$month][] = $transaction;
            }

            $totalBalance = 0;
            foreach ($transactionsByMonth as $month => $transactions) {
                $monthTotal = 0;
                setlocale(LC_TIME, 'pt_BR.utf8', 'pt_BR', 'portuguese');
                $monthName = ucfirst(strftime("%B %Y", strtotime($month)));
                echo "<li class='font-semibold text-lg mt-4'>{$monthName}</li>";

                foreach ($transactions as $transaction) {
                    $amount = $transaction['amount'];
                    $monthTotal += $amount;
                    $totalBalance += $amount;
                    $colorClass = $transaction['type'] === 'entrada' ? 'text-green-600' : 'text-red-600';
                    $formattedAmount = ($amount >= 0 ? "+ R$ " : "- R$ ") . number_format(abs($amount), 2, ',', '.');

                    echo "<li class='flex justify-between py-2 border-b {$colorClass}'>";
                    echo "<span>{$transaction['description']}</span>";
                    echo "<span>{$formattedAmount}</span>";
                    echo "</li>";
                }

                echo "<li class='text-right font-semibold " . ($monthTotal >= 0 ? 'text-green-600' : 'text-red-600') . "'>";
                echo "Saldo do mês: R$ " . number_format($monthTotal, 2, ',', '.') . "</li>";
            }
            ?>
        </ul>

        <!-- Exibir saldo total geral -->
        <div class='text-center font-bold mt-4'>
            <?php 
                $totalBalanceClass = $totalBalance >= 0 ? 'text-green-600' : 'text-red-600'; 
                echo "<span class='{$totalBalanceClass}'>Saldo Total: R$ " . number_format($totalBalance, 2, ',', '.') . "</span>"; 
            ?>
        </div>

        <!-- Botões para Cadastrar Entradas e Saídas -->
        <div class="flex justify-between mt-6">
            <button onclick="toggleModal()" class="w-1/2 mr-2 bg-green-500 text-white text-center py-2 rounded-lg hover:bg-green-600 transition-colors">
                <i class="fa fa-plus" aria-hidden="true"></i>
                Nova Entrada
            </button>

            <button onclick="toggleModal()" class="w-1/2 ml-2 bg-red-500 text-white text-center py-2 rounded-lg hover:bg-red-600 transition-colors">
                <i class="fa fa-minus" aria-hidden="true"></i>
                Nova Saída
            </button>
        </div>

        <div class="text-center mt-4 mt-5">
            <a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition-colors">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Logout</a>
        </div>
    </div>

    <!-- Modal para Nova Entrada -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Cadastrar Nova Entrada</h2>
            <form action="newEntry.php" method="POST">
                <div class="mb-4">
                    <label for="description" class="block text-gray-700">Descrição:</label>
                    <input type="text" id="description" name="description" class="border rounded-lg w-full py-2 px-3 focus:outline-none focus:ring focus:ring-green-300" placeholder="Ex: Salário">
                </div>
                <div class="mb-4">
                    <label for="amount" class="block text-gray-700">Valor:</label>
                    <input type="number" id="amount" name="amount" class="border rounded-lg w-full py-2 px-3 focus:outline-none focus:ring focus:ring-green-300" placeholder="Ex: 1000">
                </div>
                <div class="mb-4">
                    <label for="date" class="block text-gray-700">Data:</label>
                    <input type="date" id="date" name="date" class="border rounded-lg w-full py-2 px-3 focus:outline-none focus:ring focus:ring-green-300">
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
</body>
</html>
