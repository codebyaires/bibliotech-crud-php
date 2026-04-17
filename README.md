# 📚 ALEXANDRIA - bibliotech-crud-php

Um sistema web direto ao ponto para gerenciamento de biblioteca, focado no que realmente importa: a funcionalidade. 

## Sobre o Projeto

Sou estudante do Técnico em Desenvolvimento de Sistemas no SENAI e desenvolvi este projeto do zero para colocar em prática meus estudos focados em Back-end. 

A minha principal regra durante o desenvolvimento foi aplicar o princípio **KISS** (*Keep It Simple, Stupid*). Não queria um sistema super enfeitado que não funcionasse direito nos bastidores. O meu objetivo foi entregar um Produto Mínimo Viável (MVP) sólido, rápido, sem dependências complexas e com o código organizado.

## O que o sistema propõe?

O Alexandria é um CRUD (Create, Read, Update, Delete) completo de livros. Através dele, é possível:

* **Cadastrar** novos livros informando título, autor, ano, gênero, sinopse e fazendo o upload da imagem da capa.
* **Visualizar** uma vitrine com todos os livros cadastrados, utilizando um layout minimalista que dá ênfase visual às capas.
* **Editar** qualquer informação de um livro existente, incluindo a substituição da imagem de capa.
* **Excluir** livros do catálogo de forma definitiva.
* **Tratamento de Imagens:** Se um livro for cadastrado sem foto, o sistema possui uma lógica que gera uma imagem padrão de segurança (fallback) para não quebrar o layout da vitrine.

## Tecnologias Utilizadas

* **Back-end:** PHP (Vanilla)
* **Banco de Dados:** MySQL
* **Front-end:** HTML5 e Tailwind CSS (via CDN para manter a simplicidade e não pesar o projeto)

## Como rodar o projeto na sua máquina

Para testar o projeto, você precisará de um servidor local como XAMPP, WAMP ou Laragon.

1. Clone este repositório na sua pasta raiz do servidor local (ex: `htdocs` no XAMPP).
2. Abra o seu banco de dados (phpMyAdmin) e crie um banco chamado `bibliotech_db`.
3. Importe o arquivo `script.sql` que está na pasta `banco` para criar a tabela de livros automaticamente.
4. Acesse o projeto pelo seu navegador (ex: `http://localhost/bibliotech-crud-php/index.php`).

---
Desenvolvido por Victor Gabriel Aires.