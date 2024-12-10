<?php
class AtivoModel {
    private $ativo_id;
    private $nome;
    private $quantidade;
    private $preco_compra;
    private $data_compra;
    private $dy;
    private $ultimo_dividendo;
    private $data_dividendo;

    // Getters e setters para as variáveis
    public function getAtivoId() {
        return $this->ativo_id;
    }

    public function setAtivoId($ativo_id) {
        $this->ativo_id = $ativo_id;
        return $this;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
        return $this;
    }

    public function getPrecoCompra() {
        return $this->preco_compra;
    }

    public function setPrecoCompra($preco_compra) {
        $this->preco_compra = $preco_compra;
        return $this;
    }

    public function getDataCompra() {
        return $this->data_compra;
    }

    public function setDataCompra($data_compra) {
        $this->data_compra = $data_compra;
        return $this;
    }

    public function getDy() {
        return $this->dy;
    }

    public function setDy($dy) {
        $this->dy = $dy;
        return $this;
    }

    public function getUltimoDividendo() {
        return $this->ultimo_dividendo;
    }

    public function setUltimoDividendo($ultimo_dividendo) {
        $this->ultimo_dividendo = $ultimo_dividendo;
        return $this;
    }

    public function getDataDividendo() {
        return $this->data_dividendo;
    }

    public function setDataDividendo($data_dividendo) {
        $this->data_dividendo = $data_dividendo;
        return $this;
    }
}

