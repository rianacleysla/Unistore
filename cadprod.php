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
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

    :root {
        --brand-gradient: linear-gradient(135deg, #f472b6 0%, #facc15 100%);
        --bg-gradient: linear-gradient(135deg, #ffe0f0 0%, #fff8d6 50%, #ffd6e8 100%);
        --color-primary: #be185d;
        --color-primary-light: #f472b6;
        --color-border: #fbb6d4;
        --color-text-main: #831843;
        --color-text-dim: #f0abcb;
        --shadow-main: 0 8px 32px rgba(220, 80, 140, 0.15);
        --shadow-subtle: 0 2px 8px rgba(220, 80, 140, 0.08);
        --transition-fast: 0.2s ease;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        background: var(--bg-gradient);
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .container { width: 100%; max-width: 480px; }

    .card {
        background: #ffffff;
        padding: 40px 36px;
        border-radius: 24px;
        box-shadow: var(--shadow-main), var(--shadow-subtle);
        border: 1.5px solid #f9c6de;
    }

    .logo-circle {
        width: 64px; height: 64px;
        background: var(--brand-gradient);
        border-radius: 50%;
        margin: 0 auto 20px;
        display: flex; align-items: center; justify-content: center;
        font-size: 26px;
    }

    h2 {
        text-align: center;
        color: var(--color-primary);
        font-size: 22px; font-weight: 600;
        margin-bottom: 6px;
    }

    .subtitle {
        text-align: center;
        color: var(--color-text-dim);
        font-size: 13px; margin-bottom: 28px;
    }

    .row { display: flex; gap: 14px; }
    .row .field { flex: 1; }

    label {
        display: block;
        font-size: 11px; font-weight: 600;
        color: var(--color-primary);
        margin-bottom: 8px;
        text-transform: uppercase; letter-spacing: 0.8px;
    }

    input, select, textarea {
        width: 100%;
        padding: 12px 16px;
        margin-bottom: 20px;
        border: 1.5px solid var(--color-border);
        border-radius: 12px;
        background: #fff5fa;
        font-family: inherit; font-size: 14px;
        color: var(--color-text-main);
        outline: none;
        transition: var(--transition-fast);
        appearance: none; -webkit-appearance: none;
    }

    input:focus, select:focus, textarea:focus {
        border-color: var(--color-primary-light);
        box-shadow: 0 0 0 3px rgba(244, 114, 182, 0.15);
        background: #ffffff;
    }

    input::placeholder, textarea::placeholder { color: var(--color-text-dim); }

    select {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23be185d' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        padding-right: 36px;
        cursor: pointer;
    }

    textarea { resize: vertical; min-height: 90px; }

    /* Input de arquivo estilizado */
    input[type="file"] {
        padding: 10px 14px;
        cursor: pointer;
        background: #fff5fa;
    }

    input[type="file"]::file-selector-button {
        border: none;
        background: var(--brand-gradient);
        color: #ffffff;
        padding: 8px 14px;
        border-radius: 8px;
        font-family: inherit;
        font-size: 12px;
        font-weight: 600;
        margin-right: 12px;
        cursor: pointer;
        transition: var(--transition-fast);
    }

    input[type="file"]::file-selector-button:hover {
        opacity: 0.9;
    }

    .preview-imagem {
        display: none;
        width: 100%;
        max-height: 180px;
        object-fit: cover;
        border-radius: 12px;
        margin-top: -8px;
        margin-bottom: 20px;
        border: 1.5px solid var(--color-border);
    }

    button {
        width: 100%; padding: 14px;
        background: var(--brand-gradient);
        color: #ffffff; border: none;
        border-radius: 12px;
        font-size: 15px; font-weight: 600;
        font-family: inherit; cursor: pointer;
        transition: transform 0.1s, opacity 0.2s, box-shadow 0.2s;
        margin-top: 4px;
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }

    button:hover {
        opacity: 0.95; transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(244, 114, 182, 0.2);
    }

    button:active { transform: translateY(0px); }

    .erro, .sucesso {
        font-size: 13px; font-weight: 500;
        text-align: center; padding: 12px;
        margin-bottom: 20px;
        border-radius: 10px; border: 1px solid;
    }

    .erro   { color: #be123c; background: #fff1f5; border-color: #fda4af; }
    .sucesso { color: #166534; background: #f0fdf4; border-color: #86efac; }

    .footer-link {
        text-align: center; margin-top: 24px;
        font-size: 13px; color: var(--color-text-dim);
    }

    .footer-link a {
        color: var(--color-primary); font-weight: 600;
        text-decoration: none; transition: color 0.2s;
    }

    .footer-link a:hover { text-decoration: underline; color: var(--color-primary-light); }
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
                    <input name="preco" type="text" placeholder="Ex: um abraço verdadeiro" required
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