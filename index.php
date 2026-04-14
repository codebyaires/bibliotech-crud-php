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
            <a href="index.html" class="flex items-center gap-2 text-white font-extrabold text-lg">📚​ ALEXANDRIA</a>
            <input type="text" class="rounded-full pl-10 pr-4 py-2" placeholder="Pesquisar...">
            <div class="flex-1"></div>
            <span class="text-white">Hello, <strong class="text-white">User</strong></span>
            <!-- <a href="login.html" class="bg-senai-red text-white text-xs font-semibold px-3 py-1.5 rounded hover:bg-red-700 transition">Sair</a> -->
        </div>
    </nav>

    <!-- CABEÇALHO DA PÁGINA -->
    <div class="bg-white border-b border-gray-200 px-6 py-5">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-2xl font-extrabold text-gray-800">Catálogo de Livros</h1>
            <p class="text-sm text-gray-500 mt-1">Escolha um livro que deseja conhecer melhor</p>
        </div>
    </div>

        <div class="max-w-6xl mx-auto px-5 py-3 flex items-center gap-5">
        <a href="formulario.php"><strong class="text-black">Adicionar novos Livros</strong></a>
        </div>

    <!-- GRADE DE LIVROS -->
    <main class="max-w-6xl mx-auto px-6 py-8 flex-1">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <?php while ($livro = mysqli_fetch_assoc($resultado_livros)): ?>

            <div class="bg-white rounded-xl shadow hover:shadow-md transition overflow-hidden flex flex-col border-2 border-green-400">
                <div class="relative">
                    <div class="bg-gradient-to-br from-orange-500 to-orange-700 h-72 flex items-center justify-center">

                        <?php if(!empty($livro['capa'])): ?>
                            <img src="uploads/<?php echo $livro['capa']; ?>" alt="Capa" class="w-full h-full object-cover object-center">
                        <?php else: ?>
                            <img src="uploads/placeholder.png" class="w-full h-full object-cover object-center">
                        <?php endif; ?>
                    </div>
  
                </div>
                <div class="p-3 flex flex-col flex-1">
                    <h3 class="font-bold text-gray-800 text-base mb-1"><?php echo $livro['titulo'];?>></h3>
                    <p class="text-sm text-gray-30 mb-3 flex-1">
                        <?php echo $livro['autor']; ?>
                    </p>
                   
                    <a href="livro.html" class="bg-senai-green text-white text-sm font-semibold py-2.5 rounded-lg text-center hover:bg-green-600 transition">
                        Ler mais →
                    </a>
                </div>
            </div>
             <?php endwhile; ?>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-gray-400 text-center py-4 text-xs mt-auto">
        ALEXANDRIA - Bliblioteca Online &nbsp;|&nbsp; © 2026 Todos os direitos reservados
    </footer>

</body>
</html>
