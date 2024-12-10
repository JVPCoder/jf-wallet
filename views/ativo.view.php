<head>
    <script>
        function toggleModal() {
            const modal = document.getElementById('modal');
            modal.classList.toggle('hidden');
        }

        function toggleCalcModal() {
            const calcmodal = document.getElementById('calcmodal');
            calcmodal.classList.toggle('hidden');
        }

        function confirmarDelete(ativoId) {
            if (confirm('Deseja excluir este ativo?')) {
                const form = document.createElement('form');
                form.action = '/jf-wallet/ativo/deletar';
                form.method = 'POST';

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                const idInput = document.createElement('input');
                idInput.type = 'hidden';
                idInput.name = 'ativoId';
                idInput.value = ativoId;
                form.appendChild(idInput);


                document.body.appendChild(form);
                form.submit();
            }
        }


        function submitCalculator(event) {
            event.preventDefault();  // Evita o envio do formulário

            // Coleta os dados do formulário
            const qtd = parseInt(document.querySelector("#qtd").value);
            const dividend = parseFloat(document.querySelector("#dividend").value);
            const time = parseInt(document.querySelector("#time").value);

            // Valida se todos os campos estão preenchidos corretamente
            if (qtd > 0 && dividend > 0 && time > 0) {
                // Realiza o cálculo
                const totalDividend = qtd * dividend * time;

                // Exibe o resultado
                const calcresult = document.getElementById("results");
                calcresult.innerHTML = `
                    <h2 class="text-2xl font-semibold text-gray-700 text-center mb-4">Resultado da Simulação</h2>
                    <p class="text-center">Com ${qtd} papéis/cotas, recebendo R$ ${dividend.toFixed(2).replace('.', ',')} de dividendo cada, durante ${time} meses:</p>
                    <p class="text-center font-bold">Total de Dividendos (aproximadamente): R$ ${totalDividend.toFixed(2).replace('.', ',')}</p>
                `;
                calcresult.classList.remove("hidden"); // Exibe a seção de resultados
            } else {
                // Caso algum campo não esteja preenchido corretamente
                const calcresult = document.getElementById("results");
                calcresult.innerHTML = "<p style='color: red; text-align: center;'>Por favor, preencha todos os campos corretamente.</p>";
                calcresult.classList.remove("hidden");
            }
        }


    </script>
</head>

<div class="bg-white m-auto shadow-md rounded-lg w-full max-w-4xl p-6 mt-6">
    <h2 class="text-2xl font-semibold text-gray-700 text-center mb-4">Listagem de Ativos</h2>

    <?php if (!empty($mensagem_erro)): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <?= htmlspecialchars($mensagem_erro) ?>
        </div>
    <?php endif; ?>

    <!-- Tabela de Ativos -->
    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="border-b px-4 py-2 text-left text-gray-700">Nome</th>
                <th class="border-b px-4 py-2 text-left text-gray-700">Qtd Cotas</th>
                <th class="border-b px-4 py-2 text-left text-gray-700">Preço (Cota)</th>
                <th class="border-b px-4 py-2 text-left text-gray-700">Último Dividendo</th>
                <th class="border-b px-4 py-2 text-left text-gray-700">Yield (%)</th>
                <th class="border-b px-4 py-2 text-left text-gray-700">Data de Compra</th>
                <th class="border-b px-4 py-2 text-left text-gray-700">Último Pagamento</th>
                <th class="border-b px-4 py-2 text-left text-gray-700">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ativos as $ativo): ?>
                <tr class="border-b">
                    <td class="px-4 py-2"><?= htmlspecialchars($ativo->getNome()) ?></td>
                    <td class="px-4 py-2"><?= htmlspecialchars($ativo->getQuantidade()) ?></td>
                    <td class="px-4 py-2">R$ <?= number_format($ativo->getPrecoCompra(), 2, ',', '.') ?></td>
                    <td class="px-4 py-2">R$ <?= number_format($ativo->getUltimoDividendo(), 2, ',', '.') ?></td>
                    <td class="px-4 py-2"><?= htmlspecialchars($ativo->getDy()) ?>%</td>
                    <td class="px-4 py-2"><?= date("d/m/Y", strtotime($ativo->getDataCompra())) ?></td>
                    <td class="px-4 py-2"><?= date("d/m/Y", strtotime($ativo->getDataDividendo())) ?></td>
                    <td class="px-4 py-2">
                        <button onclick="confirmarDelete(<?= $ativo->getAtivoId() ?>)" class="text-red-500">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="flex justify-between mt-6">
        <button onclick="toggleModal()" class="w-1/2 mr-2 bg-green-500 text-white text-center py-2 rounded-lg hover:bg-green-600 transition-colors">
            <i class="fa fa-plus" aria-hidden="true"></i>
            Novo Ativo
        </button>

        <button onclick="toggleCalcModal()" class="w-1/2 ml-2 bg-yellow-500 text-white text-center py-2 rounded-lg hover:bg-yellow-600 transition-colors">
                <i class="fa fa-calculator" aria-hidden="true"></i>
                Simulador de Dividendo
        </button>
    </div>
</div>

<!-- Modal de Cadastrar Ativo -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Cadastrar Novo Ativo</h2>
        <form action="/jf-wallet/ativo/salvar" method="POST">
            <div class="mb-4">
                <label for="nome" class="block text-gray-700">Título do fundo:</label>
                <input type="text" id="nome" name="nome" class="border rounded-lg w-full py-2 px-3" placeholder="Ex: MXRF11" required>
            </div>

            <div class="mb-4">
                <label for="quantidade" class="block text-gray-700">Quantidade de cotas:</label>
                <input type="number" id="quantidade" name="quantidade" class="border rounded-lg w-full py-2 px-3" required>
            </div>

            <div class="mb-4">
                <label for="preco_cota" class="block text-gray-700">Preço por cota (R$):</label>
                <input type="number" step="0.01" id="preco_cota" name="preco_cota" class="border rounded-lg w-full py-2 px-3" required>
            </div>

            <div class="mb-4">
                <label for="dy" class="block text-gray-700">DY (%):</label>
                <input type="number" step="0.01" id="dy" name="dy" class="border rounded-lg w-full py-2 px-3" required>
            </div>

            <div class="mb-4">
                <label for="ultimo_dividendo" class="block text-gray-700">Último Dividendo:</label>
                <input type="number" step="0.01" id="ultimo_dividendo" name="ultimo_dividendo" class="border rounded-lg w-full py-2 px-3">
            </div>

            <div class="mb-4">
                <label for="data_compra" class="block text-gray-700">Data de compra:</label>
                <input type="date" id="data_compra" name="data_compra" class="border rounded-lg w-full py-2 px-3" required>
            </div>

            <div class="mb-4">
                <label for="data_dividendo" class="block text-gray-700">Último pagamento:</label>
                <input type="date" id="data_dividendo" name="data_dividendo" class="border rounded-lg w-full py-2 px-3" required>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white text-center py-2 rounded-lg hover:bg-blue-600 transition-colors">
                Cadastrar
            </button>
        </form>

        <button onclick="toggleModal()" class="mt-4 w-full bg-red-500 text-white text-center py-2 rounded-lg hover:bg-red-600 transition-colors">
            Fechar
        </button>
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

    </div>
