<?php
session_start();
require_once "config/conexao.php";

// Intenção: selecionar todos os os livros cadastrados
$sql_livros = "SELECT * FROM livros ORDER BY id DESC";
$resultado_livros = mysqli_query($conexao, $sql_livros);

?>


<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta titulo="viewport" content="width=device-width, initial-scale=1.0">
        <title>Página de exibição dos livros</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: { extend: { colors: { senai: { red:'#C0392B', blue:'#34679A', 'blue-dark':'#2C5A85', orange:'#E67E22', green:'#27AE60' } } } }
            }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
    </head>

    <body class="bg-white">

</body>
</html>