<?php
    class TransacaoModel {
        private $transacao_id;
        private $descricao;
        private $valor;
        private $tipo;
        private $data_transacao;

        /**
         * Get the value of dataTransacao
         */ 
        public function getDataTransacao()
        {
            return $this->data_transacao;
        }

        /**
         * Set the value of dataTransacao
         *
         * @return  self
         */ 
        public function setDataTransacao($dataTransacao)
        {
            $this->data_transacao = $dataTransacao;

            return $this;
        }

        /**
         * Get the value of transacaoId
         */ 
        public function getTransacaoId()
        {
            return $this->transacao_id;
        }

        /**
         * Set the value of transacaoId
         *
         * @return  self
         */ 
        public function setTransacaoId($transacaoId)
        {
            $this->transacao_id = $transacaoId;

            return $this;
        }

        /**
         * Get the value of descricao
         */ 
        public function getDescricao()
        {
            return $this->descricao;
        }

        /**
         * Set the value of descricao
         *
         * @return  self
         */ 
        public function setDescricao($descricao)
        {
            $this->descricao = $descricao;

            return $this;
        }

        /**
         * Get the value of valor
         */ 
        public function getValor()
        {
            return $this->valor;
        }

        /**
         * Set the value of valor
         *
         * @return  self
         */ 
        public function setValor($valor)
        {
            $this->valor = $valor;

            return $this;
        }

        /**
         * Get the value of tipo
         */ 
        public function getTipo()
        {
            return $this->tipo;
        }

        /**
         * Set the value of tipo
         *
         * @return  self
         */ 
        public function setTipo($tipo)
        {
            $this->tipo = $tipo;

            return $this;
        }

    }
