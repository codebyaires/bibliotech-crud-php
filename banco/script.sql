-- Cria o Banco de Dados caso ele ainda não exista
CREATE DATABASE IF NOT EXISTS bibliotech_db;

-- Seleciona o banco de dados
USE bibliotech_db;

-- Tabela de livros:
CREATE TABLE IF NOT EXISTS livros
(
    id INT NOT NULL AUTO_INCREMENT,
    autor VARCHAR(255) NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    ano_publicacao INT NOT NULL,
    genero VARCHAR(255) NOT NULL,
    sinopse VARCHAR(500) NOT NULL,
    capa VARCHAR(255),
    PRIMARY KEY (id)
)