<?php

class EntryController {

    public function createEntry($description, $amount, $date) {
        // Verifica se os dados estão preenchidos
        if (empty($description)) {
            return [false, "A descrição é obrigatória."];
        }

        if (empty($amount)) {
            return [false, "O valor é obrigatório."];
        }

        if (empty($date)) {
            return [false, "A data é obrigatória."];
        }

        // Simulação de entrada bem-sucedida
        // Aqui você pode incluir lógica adicional para manipular a entrada
        return [true, "Entrada cadastrada com sucesso!"];
    }
}
?>
