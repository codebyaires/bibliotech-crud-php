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
        <meta titulo="viewport" content="width=device-width, initial-scale=1.0">
        <title>Página para adiconar livros novos livros, editar e excluir</title>
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
     <!-- Formulário de Cadastro --> 

</body>
</html>