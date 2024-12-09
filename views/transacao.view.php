<head>
    <script>
        function toggleModal(tipo) {
            const modal = document.getElementById('modal');
            modal.classList.toggle('hidden');

            document.getElementById('tipo').value = tipo
        }

        function confirmarDelete(transacaoId){
            if (window.confirm('Tem certeza que deseja deletar esta transação?')) {
                const form = document.createElement('form');
                form.action = '/jf-wallet/transacao/deletar';
                form.method = 'POST';

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                const idInput = document.createElement('input');
                idInput.type = 'hidden';
                idInput.name = 'transacaoId';
                idInput.value = transacaoId;
                form.appendChild(idInput);


                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</head>

<div class="bg-white m-auto mt-7 shadow-md rounded-lg w-full max-w-md p-6">
    <!-- Mensagem de Erro ou Sucesso -->
    <?php if ($mensagem_erro != ''): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <?= htmlspecialchars($mensagem_erro); ?>
        </div>
    <?php endif; ?>

    <h2 class="text-2xl font-semibold text-gray-700 text-center mb-4">Resumo de Entradas e Saídas</h2>
    <ul class="mb-2">
        <?php 
            $saldoTotal = 0;
            foreach($transacoes as $mes => $transacoesMes) :
                $totalMes = 0; 
                setlocale(LC_TIME, 'pt_BR.utf8', 'pt_BR', 'portuguese');
                $nomeMes = ucfirst(strftime("%B %Y", strtotime($mes)));
        ?>
            <li class='font-semibold text-lg mt-4'><?= $nomeMes; ?></li>
            <?php 
                foreach($transacoesMes as $transacao): 
                    $valor = $transacao->getValor();
                    $ehEntrada = $transacao->getTipo() === 'entrada';
                    $totalMes += $ehEntrada ? $valor : - $valor;
                    $saldoTotal += $ehEntrada ? $valor : - $valor;
                    $colorClass =  $ehEntrada ? 'text-green-600' : 'text-red-600';
                    $totalFormatado = ($ehEntrada ? "+ R$ " : "- R$ ") . number_format(abs($valor), 2, ',', '.');
            ?>        
                <li class='flex justify-between py-2 border-b <?=$colorClass?>'>
                    <span class='cursor-pointer text-red-700'>
                        <i class='fa fa-times' onclick=confirmarDelete(<?=$transacao->getTransacaoId()?>) aria-hidden='true'></i>
                    </span> <?= $transacao->getDescricao() ?></span>
                    <span><?=$totalFormatado?></span>
                </li>
            <?php endforeach; ?>

            <li class='text-right font-semibold <?= $totalMes >= 0 ? 'text-green-600' : 'text-red-600'?>'>
                Saldo do mês: R$ <?= number_format($totalMes, 2, ',', '.')?>
            </li>
        <?php endforeach; ?>

    </ul>

    <!-- Exibir saldo total geral -->
    <div class='text-center font-bold mt-4'>
        <?php $corSaldoTotal = $saldoTotal >= 0 ? 'text-green-600' : 'text-red-600';?>
        <span class=<?=$corSaldoTotal?>>Saldo Total: R$ <?= number_format($saldoTotal, 2, ',', '.')?> </span>
    </div>

    <!-- Botões para Cadastrar Entradas e Saídas -->
    <div class="flex justify-between mt-6">
        <button onclick="toggleModal('entrada')" class="w-1/2 mr-2 bg-green-500 text-white text-center py-2 rounded-lg hover:bg-green-600 transition-colors">
            <i class="fa fa-plus" aria-hidden="true"></i>
            Nova Entrada
        </button>

        <button onclick="toggleModal('saida')" class="w-1/2 ml-2 bg-red-500 text-white text-center py-2 rounded-lg hover:bg-red-600 transition-colors">
            <i class="fa fa-minus" aria-hidden="true"></i>
            Nova Saída
        </button>
    </div>

    <div class="text-center mt-4 mt-5">
        <a href="<?=BASE_URL . '/auth/logout' ?>" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition-colors">
            <i class="fa fa-sign-out" aria-hidden="true"></i>
            Logout</a>
    </div>
</div>

<!-- Modal para Nova Entrada -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center">
<div class="bg-white rounded-lg p-6 w-full max-w-md">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Cadastrar Nova</h2>
    <form action="/jf-wallet/transacao/salvar" method="POST">
        <div class="mb-4">
            <label for="descricao" class="block text-gray-700">Descrição:</label>
            <input type="text" id="descricao" name="descricao" class="border rounded-lg w-full py-2 px-3 focus:outline-none focus:ring focus:ring-green-300" placeholder="Ex: Salário">
        </div>
        <div class="mb-4">
            <label for="valor" class="block text-gray-700">Valor:</label>
            <input type="number" id="valor" name="valor" class="border rounded-lg w-full py-2 px-3 focus:outline-none focus:ring focus:ring-green-300" placeholder="Ex: 1000">
        </div>
        <div class="mb-4">
            <label for="data_transacao" class="block text-gray-700">Data:</label>
            <input type="date" id="data_transacao" name="data_transacao" class="border rounded-lg w-full py-2 px-3 focus:outline-none focus:ring focus:ring-green-300">
        </div>
        <div class="hidden">
            <label for="tipo" class="block text-gray-700">Tipo:</label>
            <input type="text" id="tipo" name="tipo" value="entrada">
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