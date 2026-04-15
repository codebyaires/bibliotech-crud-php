<?php
// ============================================
// Arquivo: cadastrar.php
// Função: Formulário de livros, adiciona, edita e remove
// ============================================

// Iniciar a sessão
session_start();

// Puxa a sua conexão (a variável $conexao nasce aqui)
require_once "config/conexao.php";

// Variáveis para mensagens
$sucesso = "";
$erro = "";
$editando = NULL;

// Pegar dados para edição
if (isset($_GET["editar"])) {
    $id = $_GET["editar"];
    $sql = "SELECT * FROM livros WHERE id = '$id'";
    $res = mysqli_query($conexao, $sql);
    $editando = mysqli_fetch_assoc($res);
}

// Excluir livro
if (isset($_GET["excluir"])) {
    $id = $_GET["excluir"];
    $sql = "DELETE FROM livros WHERE id = '$id'";
    $res = mysqli_query($conexao, $sql);
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recebe os dados
    $autor = trim($_POST["autor"] ?? "");
    $titulo = trim($_POST["titulo"] ?? "");
    $ano_publicacao = trim($_POST["ano_publicacao"] ?? "");
    $genero = trim($_POST["genero"] ?? "");

    // Inicializa a variável da imagem como nula
    $caminho_imagem = NULL;

    // Lógica de Upload de Imagem
    if (isset($_FILES['capa']) && $_FILES['capa']['error'] === UPLOAD_ERR_OK) {
        
        $pasta_destino = "uploads/";
        $titulo_arquivo_original = $_FILES['capa']['titulo'];
        $extensao = strtolower(pathinfo($titulo_arquivo_original, PATHINFO_EXTENSION));
        
        $extensoes_permitidas = array("jpg", "jpeg", "png", "webp");
        
        if (in_array($extensao, $extensoes_permitidas)) {
            $novo_titulo_imagem = uniqid() . "." . $extensao;
            $caminho_completo = $pasta_destino . $novo_titulo_imagem;
            
            if (move_uploaded_file($_FILES['capa']['tmp_titulo'], $caminho_completo)) {
                $caminho_imagem = $caminho_completo;
            } else {
                echo "<p style='color:red;'>Erro ao salvar a imagem na pasta.</p>";
            }
        } else {
            echo "<p style='color:red;'>Formato de arquivo não permitido. Use JPG, PNG ou WEBP.</p>";
        }
    }
    
    // Inserção no Banco de Dados (Padrão MySQLi Simples)
    if (!empty($autor) && !empty($titulo) && !empty($ano_publicacao) && !empty($genero)) {
        
        $sql = "INSERT INTO livros (autor, titulo, ano_publicacao, genero, capa) VALUES (?, ?, ?, ?, ?)";
        
        // Usa a SUA variável $conexao
        if ($stmt = $conexao->prepare($sql)) {
            
            // s = string, i = integer (ssiss: string, string, inteiro, string, string)
            $stmt->bind_param("ssiss", $autor, $titulo, $ano_publicacao, $genero, $caminho_imagem);
            
            if ($stmt->execute()) {
                echo "<p style='color:green;'>Livro cadastrado com sucesso!</p>";
            } else {
                echo "<p style='color:red;'>Erro ao cadastrar o livro. Tente novamente.</p>";
            }
            
            $stmt->close();
            
        } else {
            echo "<p style='color:red;'>Erro na preparação da query.</p>";
        }
    } else {
        echo "<p style='color:red;'>Preencha todos os campos obrigatórios.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $editando ? 'Editar Curso' : 'Novo Livro'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { colors: { senai: { red:'#C0392B', blue:'#34679A', 'blue-dark':'#2C5A85', orange:'#E67E22', green:'#27AE60' } } } }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .nav-link { display:flex; align-items:center; gap:8px; padding:8px 12px; border-radius:6px; font-size:13px; cursor:pointer; transition:background .15s; color:#cbd5e1; }
        .nav-link:hover { background:rgba(255,255,255,.08); color:#fff; }
        .nav-link.active { background:rgba(255,255,255,.15); color:#fff; font-weight:600; }
        .form-input { width:100%; border:1px solid #d1d5db; border-radius:8px; padding:10px 14px; font-size:14px; outline:none; transition:border .15s, box-shadow .15s; }
        .form-input:focus { border-color:#34679A; box-shadow: 0 0 0 3px rgba(52,103,154,.15); }
        .form-label { display:block; font-size:12px; font-weight:600; color:#6b7280; margin-bottom:6px; text-transform:uppercase; letter-spacing:.05em; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex">

    <!-- SIDEBAR -->

    <!-- CONTEÚDO -->
    <main class="flex-1 flex flex-col">

        <!-- TOPBAR -->
        <div class="bg-white border-b border-gray-200 px-6 py-4">
            <div class="flex items-center gap-2 text-xs text-gray-400 mb-1">
                <a href="index.php" class="hover:text-senai-blue">Livros</a>
                <span></span>
                <span classS"text-gray-700 font-semibold"><?php echo $editando ? 'Editar Livro' : 'Novo Livro'; ?></span>
            </div>
            <div class="flex items-center justify-between">
                <h1 class="text-gray-700 font-semibold"><?php echo $editando ? 'Editar Livro' : 'Novo Livro'; ?></h1>
                <!-- Para novo: "Cadastrar Novo Curso" sem o ?id na URL -->
                <a href="index.php" class="text-sm text-gray-500 hover:text-senai-blue flex items-center gap-1 transition">← Voltar para Biblioteca</a>
            </div>
        </div>

        <div class="p-6 flex-1">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- FORMULÁRIO PRINCIPAL -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm p-6">

                        <form action="" method="POST" enctype="multipart/form-data">

                            <!-- Campo oculto: id do curso (edição) -->
                            <input type="hidden" name="id" value="<?php echo $editando['id'] ?? ''; ?>" />

                            <!-- TÍTULO -->
                            <div class="mb-5">
                                <label class="form-label">Título do Livro *</label>
                                <input
                                    type="text"
                                    name="titulo"
                                    class="form-input"
                                    placeholder="Ex: A Revolução dos Bichos"
                                    value="<?php echo $editando['titulo'] ?? ''; ?>"
                                >
                            </div>

                            <!-- Autor -->
                            <div class="mb-5">
                                <label class="form-label">Autor *</label>
                                <input
                                    type="text"
                                    name="autor"
                                    class="form-input"
                                    placeholder="Ex: George Orwell"
                                    value="<?php echo $editando['autor'] ?? ''; ?>"
                                >
                            </div>

                            <!-- Ano de Publicação -->
                            <div class="mb-5">
                                <label class="form-label">Ano de Publicação *</label>
                                <input
                                    type="text"
                                    name="ano_publicacao"
                                    class="form-input"
                                    placeholder="Ex: 1942"
                                    value="<?php echo $editando['ano_publicacao'] ?? ''; ?>"
                                >
                            </div>

                            <!-- Genero -->
                            <div class="mb-5">
                                <label class="form-label">Genero *</label>
                                <input
                                    type="text"
                                    name="genero"
                                    class="form-input"
                                    placeholder="Ex: fábula satírica e política"
                                    value="<?php echo $editando['genero'] ?? ''; ?>"
                                >
                            </div>
                            <!-- Sinopse -->
                            <div class="mb-5">
                                <label class="form-label">Sinopse (opcional)</label>
                                <textarea
                                    name="descricao"
                                    rows="4"
                                    class="form-input resize-none"
                                    placeholder="Descreva o livro fazendo uma sinopse sobre..."
                                ><?php echo $editando['descricao'] ?? ''; ?></textarea>
                                <p class="text-xs text-gray-400 mt-1">Seja claro sobre as principais partes do lviro.</p>
                            </div>

                            <!-- IMAGEM DE CAPA -->
                            <div class="mb-5">
                                <label class="form-label">Imagem de Capa</label>
                                <div class="border-2 border-dashed border-gray-300 rounded-xl p-5 text-center hover:border-senai-blue transition cursor-pointer bg-gray-50">
                                    <!-- Preview da capa atual -->
                                    <div class="bg-gradient-to-br from-blue-500 to-blue-700 w-32 h-20 rounded-lg mx-auto mb-3 flex items-center justify-center">
                                        <span class="text-3xl">🌐</span>
                                    </div>
                                    <p class="text-xs text-gray-500 mb-2">Capa atual. Clique para alterar.</p>
                                    <input type="file" name="capa" accept="image/*" class="hidden" id="input-capa">
                                    <label for="input-capa" class="bg-white border border-gray-300 text-gray-600 text-xs font-semibold px-4 py-2 rounded-lg cursor-pointer hover:bg-gray-50 transition">
                                        Selecionar nova imagem
                                    </label>
                                    <p class="text-xs text-gray-400 mt-2">PNG, JPG ou WEBP. Máx. 2MB. Proporção recomendada: 16:9</p>
                                </div>
                            </div>

                            <!-- BOTÕES -->
                            <div class="flex gap-3 pt-2 border-t border-gray-100">
                                <button type="submit" class="bg-senai-blue hover:bg-senai-blue-dark text-white font-bold px-6 py-2.5 rounded-lg text-sm transition flex items-center gap-2">
                                    💾 Salvar Alterações
                                </button>
                                <a href="index.php" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-2.5 rounded-lg text-sm transition">
                                    Cancelar
                                </a>
                            </div>

                        </form>
                    </div>
                </div>

                    <!-- Aviso exclusão -->

                    <?php if($editando): ?>
                        <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                            <h4 class="font-bold text-senai-red text-sm mb-2">⚠ Zona de Perigo</h4>
                            <a href="?excluir=<?php echo $editando['id']; ?>" onclick="return confirm('Tem certeza? Esta ação não pode ser desfeita.')" class="block text-center w-full bg-senai-red text-white text-xs font-bold py-2 rounded-lg hover:bg-red-700 transition">
                                🗑 Excluir este curso
                            </a>
                        </div>
                        <?php endif; ?>

                </div>
            </div>
        </div>
    </main>

</body>
</html>