<?php
session_start();
require_once "config/conexao.php";

// Intenção: selecionar todos os os livros cadastrados
$sql_livros = "SELECT * FROM livros ORDER BY id DESC";
$resultado_livros = mysqli_query($conexao, $sql_livros);

// Excluir livro
if (isset($_GET["excluir"])) {
    $id = $_GET["excluir"];
    $sql = "DELETE FROM livros WHERE id = '$id'";
    $res = mysqli_query($conexao, $sql);
    
    // Redireciona de volta para a lista após excluir
     header("Location: index.php");
    exit;
}

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
            <input type="text" class="rounded-full pl-10 pr-4 py-1.5 outline-none focus:ring-2 focus:ring-white/50 text-sm w-full max-w-xs" placeholder="Pesquisar...">
            <div class="flex-1"></div>
            <span class="text-white text-sm">Hello, <strong class="text-white">User</strong></span>
        </div>
    </nav>

    <div class="bg-white border-b border-gray-200 px-6 py-5">
        <div class="max-w-6xl mx-auto flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-800">Catálogo de Livros</h1>
                <p class="text-sm text-gray-500 mt-1">Escolha um livro que deseja conhecer melhor</p>
            </div>
            <a href="formulario.php" class="bg-senai-blue text-white font-semibold px-5 py-2.5 rounded-lg hover:bg-senai-blue-dark transition shadow-sm flex items-center gap-2 text-sm">
                + Adicionar Livro
            </a>
        </div>
    </div>

    <main class="max-w-6xl mx-auto px-6 py-8 flex-1 w-full">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <?php while ($livro = mysqli_fetch_assoc($resultado_livros)): ?>

            <div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition-shadow duration-300 overflow-hidden flex flex-col border border-gray-200">
                
                <div class="relative">
                    <div class="bg-gradient-to-br from-orange-500 to-orange-700 h-72 flex items-center justify-center">
                    <?php if(!empty($livro['capa'])): ?>
                        <img src="uploads/<?php echo $livro['capa']; ?>" alt="Capa" class="w-full h-full object-cover object-center">
                    <?php else: ?>
                        <span class="text-white opacity-50 text-xs uppercase tracking-wider font-semibold">Sem Capa</span>
                    <?php endif; ?>
                    </div>
                </div>
                
                <div class="px-4 pt-4 pb-2 flex flex-col flex-1">
                    
                    <h3 class="font-bold text-gray-800 text-base mb-1 truncate" title="<?php echo htmlspecialchars($livro['titulo']); ?>">
                        <?php echo htmlspecialchars($livro['titulo']); ?>
                    </h3>
                    
                    <p class="text-sm text-gray-500 mb-4 truncate" title="<?php echo htmlspecialchars($livro['autor']); ?>">
                        <?php echo htmlspecialchars($livro['autor']); ?>
                    </p>
                    
                    <a href="livro.php?id=<?php echo $livro['id']; ?>" class="mt-auto bg-senai-green text-white text-sm font-semibold py-2 rounded-lg text-center hover:bg-green-700 transition w-full">
                      Ler mais →
                     </a>
                </div>

                <div class="bg-gray-50 border-t border-gray-100 p-3 flex items-center justify-between gap-2 mt-auto">
                    <a href="formulario.php?editar=<?php echo $livro['id']; ?>" class="flex-1 text-center bg-white border border-gray-300 text-gray-700 text-xs font-semibold px-2 py-1.5 rounded hover:bg-gray-100 transition" title="Editar">
                        ✏️ Editar
                    </a>
                    <a href="index.php?excluir=<?php echo $livro['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir o livro \'<?php echo addslashes($livro['titulo']); ?>\'?')" class="flex-1 text-center bg-red-50 border border-red-200 text-senai-red text-xs font-semibold px-2 py-1.5 rounded hover:bg-red-100 transition" title="Excluir">
                        🗑️ Excluir
                    </a>
                </div>

            </div>
             <?php endwhile; ?>
        </div>
    </main>

    <footer class="bg-gray-900 text-gray-400 text-center py-4 text-xs mt-auto">
        ALEXANDRIA - Biblioteca Online &nbsp;|&nbsp; © 2026 Todos os direitos reservados
    </footer>

</body>
</html>