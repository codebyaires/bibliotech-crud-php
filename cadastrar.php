<?php
// ============================================
// Arquivo: cadastrar.php
// Função: Cadastro de livros (área restrita)
// ============================================

// Iniciar a sessão
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
     // Recebe os dados e remove espaços em branco extras
     $autor = trim($_POST["autor"] ?? "");
     $titulo = trim($_POST["titulo"] ?? "");
     $ano_pubicacao = trim($_POST["ano_pubicacao"] ?? "");
     $genero = trim($_POST["genero"] ?? "");

     if (empty($autor) || empty($titulo) || empty($ano_publicacao) || empty($genero)) {
        $erro = "Por favor, preencha todos os campos.";
     } else { 
        echo "sucesso";
     }
}
?>