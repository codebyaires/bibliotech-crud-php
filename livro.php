<?php
session_start();
require_once "config/conexao.php";

// $usuario_id = $_SESSION["usuario_id"];

// Pega o ID do livro que o úsuario clicou
$livro_id = $_GET["id"] ?? 0;

// Busca os dados APENAS DESTE livro (para colocar o título e a capa lá no cabeçalho)
$sql_livro = "SELECT * FROM livros WHERE id = '$livro_id'";
$livro = mysqli_fetch_assoc(mysqli_query($conexao, $sql_livro));
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Livros — ALEXANDRIA</title>
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
<body class="bg-gray-50 min-h-screen flex flex-col">

    <!-- NAVBAR -->
    <nav class="bg-senai-red shadow-md sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-2 py-3 flex items-center gap-6">
            <a href="index.php" class="flex items-center gap-2 text-white font-extrabold text-lg">📚​ ALEXANDRIA</a>
            <div class="flex-1"></div>
            <!-- <a href="login.html" class="bg-senai-red text-white text-xs font-semibold px-3 py-1.5 rounded hover:bg-red-700 transition">Sair</a> -->
        </div>
    </nav>
        

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-gray-400 text-center py-4 text-xs">
        SENAI — Sistema EAD &nbsp;|&nbsp; © 2025 Todos os direitos reservados
    </footer>

</body>
</html>
