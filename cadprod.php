<?php
include "conexao.php";

$mensagem = "";

if (isset($_POST['inserir'])) {

    $nome        = trim($_POST['nome']);
    $categoria   = trim($_POST['categoria']);
    $preco       = trim($_POST['preco']);
    $erro        = false;
    $nomeImagem  = "";

    // Validações
    if (empty($nome)) {
        $mensagem .= "<p class='erro'>O nome do produto é obrigatório.</p>";
        $erro = true;
    }

    if (empty($categoria)) {
        $mensagem .= "<p class='erro'>Selecione uma categoria.</p>";
        $erro = true;
    }

    if (empty($preco)) {
        $mensagem .= "<p class='erro'>O preço é obrigatório.</p>";
        $erro = true;
    }

    // Tratamento da imagem (opcional - só valida se o usuário enviou algo)
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {

        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));

        if (!in_array($extensao, $extensoesPermitidas)) {
            $mensagem .= "<p class='erro'>Formato de imagem inválido. Use JPG, PNG, GIF ou WEBP.</p>";
            $erro = true;
        } else {
            // Gera um nome único pra evitar sobrescrever arquivos
            $nomeImagem = uniqid('produto_', true) . '.' . $extensao;
            $caminhoDestino = __DIR__ . '/uploads/' . $nomeImagem;

            if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoDestino)) {
                $mensagem .= "<p class='erro'>Erro ao salvar a imagem.</p>";
                $erro = true;
            }
        }
    }

    // Se não houver erro, insere no banco usando prepared statement
    if (!$erro) {

        $sql  = "INSERT INTO produtos (nome, categoria, preco, imagem) VALUES (?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssss", $nome, $categoria, $preco, $nomeImagem);

            if ($stmt->execute()) {
                $mensagem = "<p class='sucesso'>✓ Produto cadastrado com sucesso!</p>";
            } else {
                $mensagem = "<p class='erro'>Erro ao cadastrar: " . $stmt->error . "</p>";
            }
            $stmt->close();
        } else {
            $mensagem = "<p class='erro'>Erro ao preparar a consulta: " . $conexao->error . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro de Produto</title>

<style>
      margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:'Segoe UI', sans-serif;
    }
 
    body{
        background: linear-gradient(135deg, #ffe6f2, #ffd6eb);
        display:flex;
        justify-content:center;
        align-items:center;
        min-height:100vh;
        padding:20px;
    }
 
    .container{
        width:100%;
        max-width:420px;
        background:white;
        padding:35px;
        border-radius:20px;
        box-shadow:0 10px 25px rgba(0,0,0,0.15);
    }
 
    .logo{
        display:block;
        margin:0 auto 15px auto;
        font-size:40px;
        text-align:center;
    }
 
    h2{
        text-align:center;
        color:#8b3a62;
        margin-bottom:6px;
    }
 
    .subtitulo{
        text-align:center;
        color:#c084a8;
        font-size:13px;
        margin-bottom:20px;
    }
 
    form{
        display:flex;
        flex-direction:column;
    }
 
    label{
        margin-top:12px;
        margin-bottom:5px;
        color:#8b3a62;
        font-weight:600;
        font-size:14px;
    }
 
    input, select{
        padding:12px;
        border-radius:12px;
        border:1px solid #f8c8dc;
        outline:none;
        transition:0.3s;
        font-family:inherit;
        font-size:14px;
        color:#5c2a44;
        background:#fffafc;
        appearance:none;
        -webkit-appearance:none;
    }
 
    select{
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%238b3a62' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat:no-repeat;
        background-position: right 14px center;
        padding-right:36px;
        cursor:pointer;
    }
 
    input:focus, select:focus{
        border-color:#d63384;
        box-shadow:0 0 8px rgba(214,51,132,0.3);
    }
 
    input[type="file"]{
        padding:8px;
        cursor:pointer;
        background:#fffafc;
    }
 
    input[type="file"]::file-selector-button{
        border:none;
        background:#d63384;
        color:white;
        padding:8px 14px;
        border-radius:20px;
        font-family:inherit;
        font-size:12px;
        font-weight:bold;
        margin-right:12px;
        cursor:pointer;
        transition:0.3s;
    }
 
    input[type="file"]::file-selector-button:hover{
        background:#c2186a;
    }
 
    .preview-imagem{
        display:none;
        width:100%;
        max-height:160px;
        object-fit:cover;
        border-radius:12px;
        margin-top:10px;
        border:1px solid #f8c8dc;
    }
 
    button{
        margin-top:25px;
        padding:12px;
        border:none;
        border-radius:25px;
        background:#d63384;
        color:white;
        font-size:16px;
        font-weight:bold;
        cursor:pointer;
        transition:0.3s;
    }
 
    button:hover{
        background:#c2186a;
        transform:scale(1.03);
    }
 
    .mensagem{
        margin-top:15px;
        text-align:center;
        font-weight:bold;
        color:#8b3a62;
    }
 
    .erro, .sucesso{
        font-size:13px;
        font-weight:600;
        text-align:center;
        padding:12px;
        margin-bottom:15px;
        border-radius:12px;
        border:1px solid;
    }
 
    .erro{ color:#c2186a; background:#fff1f5; border-color:#f8c8dc; }
    .sucesso{ color:#166534; background:#f0fdf4; border-color:#86efac; }
 
    .footer-link{
        text-align:center;
        margin-top:20px;
        font-size:13px;
        color:#c084a8;
    }
 
    .footer-link a{
        color:#d63384;
        font-weight:600;
        text-decoration:none;
    }
 
    .footer-link a:hover{ text-decoration:underline; }

</style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="logo-circle">🛍️</div>
        <h2>Novo Produto</h2>
        <p class="subtitle">Preencha os dados para cadastrar</p>

        <?php echo $mensagem; ?>

        <form method="post" enctype="multipart/form-data">

            <label>Nome do Produto</label>
            <input name="nome" type="text" placeholder="Ex: Camiseta Floral" required
                    value="<?php echo htmlspecialchars($_POST['nome'] ?? ''); ?>">

            <label>Categoria</label>
            <select name="categoria" required>
                <option value="">Selecione...</option>
                <option value="Roupas"      <?php echo (($_POST['categoria'] ?? '') === 'Roupas')      ? 'selected' : ''; ?>>Roupas</option>
                <option value="Calçados"    <?php echo (($_POST['categoria'] ?? '') === 'Calçados')    ? 'selected' : ''; ?>>Calçados</option>
                <option value="Acessórios"  <?php echo (($_POST['categoria'] ?? '') === 'Acessórios')  ? 'selected' : ''; ?>>Acessórios</option>
                <option value="Eletrônicos" <?php echo (($_POST['categoria'] ?? '') === 'Eletrônicos') ? 'selected' : ''; ?>>Eletrônicos</option>
                <option value="Outros"      <?php echo (($_POST['categoria'] ?? '') === 'Outros')      ? 'selected' : ''; ?>>Outros</option>
            </select>

            <div class="row">
                <div class="field">
                    <label>Preço</label>
                    <input name="preco" type="text" required
                            value="<?php echo htmlspecialchars($_POST['preco'] ?? ''); ?>">
                </div>
            </div>

            <label>Imagem do Produto</label>
            <input name="imagem" type="file" accept="image/*">

            <button type="submit" name="inserir">Cadastrar Produto</button>
        </form>

        <p class="footer-link">Ver todos os produtos? <a href="produtos.php">Listar</a></p>
    </div>
</div>

</body>
</html>