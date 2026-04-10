<?php
session_start();
require_once "config/conexao.php";

// Intenção: selecionar todos os os livros cadastrados
$sql_livros = "SELECT * FROM livros ORDER BY id DESC";
$resultado_livros = mysqli_query($conexao, $sql_livros);

?>