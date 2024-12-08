<div class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <!-- Mensagem de Erro -->
        <?php if ($mensagem_erro != ''): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <?= htmlspecialchars($mensagem_erro); ?>
            </div>
        <?php endif; ?>
        <h2 class="text-2xl font-semibold text-gray-700 text-center mb-6">Login</h2>
        <form method="POST" action="index.php">
            <div class="mb-4">
                <label for="email" class="block text-gray-600 mb-1">Email:</label>
                <input type="email" id="email" name="email" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-6">
                <label for="senha" class="block text-gray-600 mb-1">Senha:</label>
                <input type="password" id="senha" name="senha" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition-colors">
                Entrar
            </button>
        </form>
    </div>
</div>
