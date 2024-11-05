# 💰 J&F Wallet - Carteira de organização financeira e ações | PHP

## 💡 Tecnologias Utilizadas

- 🚀 **Linguagem Principal:** PHP
- 🎨 **Estilização:** TailwindCSS e FontAwesome
- 🧑🏻‍💻 **OBS:** É recomendado o uso de XAMPP para rodar o projeto localmente

## 🤓 Equipe

- João Vitor Queiroz de Campos Pires
- Luiz Fernando Mattos
- **OBS:** Não ouve divisão específica de quem faz o que, sempre consultamos um ao outro para tomar cada passo no projeto, feito em conjunto e respeitando o tempo disponível de cada um.

## 📝 Resumo do Projeto

**Descrição:** 
A J&F Wallet tem como objetivo ajudar as pessoas a monitorarem  entradas e saídas de dinheiro de forma prática, mas também abrange o lado de ações, sendo capaz de registrar e calcular possíveis dividendos. 
Foi desenvolvido em PHP e segue as boas práticas de desenvolvimento (utilizando padrão MVC) e está documentado para facilitar a manutenção.

## 🤔 Explicações sobre o Site/Aplicação

**Geral**: Em geral a J&F Wallet ainda está em desenvolvimento, por enquanto apenas o front-end está totalmente funcional, as possíveis requisições para o banco estão funcionais porém foram mockadas para manter o escopo da entrega.

## 🗂️ Views

- **Login:**  
  Página que é responsável por autenticar o usuário (E futuro registro de usuários).

- **Dashboard:**  
  Tela principal da aplicação, lista entradas e saídas, podendo futuramente também adicionar e remover.

- **Ações:**  
  Esta página exibe uma tabela descritiva de possíveis ações que o usuário possa ter, contando também com uma calculadora que simula os dividendos que serão pagos em um período de meses.

## ⚙️ Funcionalidades Principais

- **Listagem de entradas e saídas**

- **Adição e remoção de novas entradas ou saídas**

- **Listagem de ações**

- **Adição e remoção de ações**

- **Simulador de Dividendos**

## 🛠️ Como Executar o Projeto

1. **Clone o Repositório na sua pasta htdocs do XAMPP:**
   ```bash
   git clone https://github.com/JVPCoder/jf-wallet.git
   ```

2. **Instale as Dependências:**
   ```bash
   npm install
   ```

3. **Ligue o Apache e o MYSQL do XAMPP**

4. **Acesse o banco de dados e crie uma database jf_db**:
   ```bash
   CREATE DATABASE jf_db;
   ```

5. **Após isso crie uma tabela "users" com os seguintes atributos:**
   ```bash
   CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL
    );
   ```

6. **Insira um novo usuário na tabela "users" seguindo os atributos mostrados. Exemplo:**
   ```bash
   INSERT INTO `users`(`email`, `password`) VALUES ('admin','1234')
   ```   

7. **Com o usuário criado no banco de dados já é possível acessar a aplicação no seu navegador:**
   ```bash
   localhost/jf-wallet
   ```

---

## 🛡️ Licença:
Esse software é licenciado através da MIT license.
