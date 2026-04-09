<?php 
// ============================================
// Arquivo: conexao.php
// Função: Conectar o PHP ao banco de dados MySQL
// ============================================


// Dados de conexão com o banco
$servidor = "localhost";
$usuario  = "root";
$senha    = "";
$banco    = "bibliotech_db";

// Criar a conexão usando mysqli
$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

// Verificar se a conexão funcionou
if (!$conexao) {
    die("Erro ao conectar com o banco de dados: " . mysqli_connect_error());
}

// Definir o charset para aceitar acentos
mysqli_set_charset($conexao, "utf8mb4");