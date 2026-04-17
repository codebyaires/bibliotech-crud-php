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
<nav class="bg-senai-red shadow-md sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-6 py-3 flex items-center gap-6">
            <a href="index.php" class="flex items-center gap-2 text-white font-extrabold text-lg">📚​ ALEXANDRIA</a>
            <div class="flex-1"></div>
        </div>
    </nav>
        
    <main class="max-w-4xl mx-auto px-6 py-10 flex-1 w-full">

        <div class="mb-6">
            <a href="index.php" class="text-gray-500 hover:text-senai-blue text-sm font-semibold flex items-center gap-2 transition w-fit">
                ← Voltar para o Catálogo
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 md:p-12">

            <div class="flex flex-col sm:flex-row gap-6 md:gap-8 items-start border-b border-gray-100 pb-8 mb-8">

                <div class="w-32 md:w-40 flex-shrink-0 bg-gradient-to-br from-orange-500 to-orange-700 rounded-lg overflow-hidden shadow-md aspect-[2/3] relative flex items-center justify-center">
                    <?php if(!empty($livro['capa'])): ?>
                        <img src="uploads/<?php echo htmlspecialchars($livro['capa']); ?>" alt="Capa" class="w-full h-full object-cover object-center absolute inset-0">
                    <?php else: ?>
                        <span class="text-white opacity-50 text-xs uppercase tracking-wider font-semibold z-10 text-center px-2">Sem Capa</span>
                    <?php endif; ?>
                </div>

                <div class="flex-1 pt-2">
                    <div class="flex items-center flex-wrap gap-2 mb-4">
                        <span class="bg-blue-50 text-senai-blue text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide border border-blue-100">
                            <?php echo htmlspecialchars($livro['genero']); ?>
                        </span>
                        <span class="bg-gray-100 text-gray-600 text-xs font-bold px-3 py-1 rounded-full border border-gray-200">
                            <?php echo htmlspecialchars($livro['ano_publicacao']); ?>
                        </span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-800 mb-2 leading-tight">
                        <?php echo htmlspecialchars($livro['titulo']); ?>
                    </h1>
                    <p class="text-lg text-gray-500 font-medium">
                        por <span class="text-gray-700"><?php echo htmlspecialchars($livro['autor']); ?></span>
                    </p>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-5">Sinopse / Resenha</h3>
                <p class="text-gray-800 text-lg leading-relaxed whitespace-pre-wrap text-justify"><?php echo htmlspecialchars($livro['sinopse']); ?></p>
            </div>

        </div>

    </main>

    <footer class="bg-gray-900 text-gray-400 text-center py-4 text-xs">
        ALEXANDRIA - Biblioteca Online &nbsp;|&nbsp; © 2026 Todos os direitos reservados
    </footer>

</body>
</html>
