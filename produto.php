<?php
include "conexao.php";

// Busca todos os produtos cadastrados, do mais recente pro mais antigo
$sql = "SELECT id, nome, categoria, preco, imagem FROM produtos ORDER BY id DESC";
$resultado = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lista de Produtos</title>

<style>
      *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:'Segoe UI', sans-serif;
    }
 
    body{
        background: linear-gradient(135deg, #ffe6f2, #ffd6eb);
        min-height:100vh;
        padding:40px 20px;
    }
 
    .pagina{
        width:100%;
        max-width:1100px;
        margin:0 auto;
    }
 
    .header-bar{
        display:flex;
        align-items:center;
        justify-content:space-between;
        flex-wrap:wrap;
        gap:16px;
        margin-bottom:30px;
    }
 
    .titulo-area h2{
        color:#8b3a62;
        font-size:24px;
        margin-bottom:4px;
    }
 
    .titulo-area p{
        color:#c084a8;
        font-size:13px;
    }
 
    .btn-novo{
        background:#d63384;
        color:white;
        padding:12px 22px;
        border-radius:25px;
        text-decoration:none;
        font-size:14px;
        font-weight:bold;
        box-shadow:0 6px 16px rgba(214,51,132,0.25);
        transition:0.3s;
        white-space:nowrap;
    }
 
    .btn-novo:hover{
        background:#c2186a;
        transform:scale(1.03);
    }
 
    .grid-produtos{
        display:grid;
        grid-template-columns:repeat(auto-fill, minmax(220px, 1fr));
        gap:22px;
    }
 
    .card-produto{
        background:white;
        border-radius:20px;
        overflow:hidden;
        box-shadow:0 10px 25px rgba(0,0,0,0.10);
        transition:transform 0.2s ease;
    }
 
    .card-produto:hover{ transform:translateY(-4px); }
 
    .imagem-produto{
        width:100%;
        height:160px;
        object-fit:cover;
        background:#fffafc;
        display:block;
    }
 
    .imagem-placeholder{
        width:100%;
        height:160px;
        background:#fffafc;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:40px;
        color:#f8c8dc;
    }
 
    .info-produto{ padding:16px 18px 20px; }
 
    .categoria-tag{
        display:inline-block;
        background:#fff1f5;
        color:#d63384;
        font-size:10px;
        font-weight:bold;
        text-transform:uppercase;
        letter-spacing:0.6px;
        padding:4px 10px;
        border-radius:100px;
        margin-bottom:10px;
    }
 
    .nome-produto{
        font-size:15px;
        font-weight:600;
        color:#5c2a44;
        margin-bottom:6px;
        line-height:1.3;
    }
 
    .preco-produto{
        font-size:14px;
        font-weight:bold;
        color:#d63384;
    }
 
    .estado-vazio{
        background:white;
        border-radius:20px;
        padding:60px 30px;
        text-align:center;
        box-shadow:0 10px 25px rgba(0,0,0,0.10);
    }
 
    .estado-vazio .icone{ font-size:40px; margin-bottom:12px; }
    .estado-vazio strong{ color:#8b3a62; }
    .estado-vazio p{ color:#c084a8; font-size:14px; margin-top:8px; }
</style>
</head>
<body>
<div class="container">

    <div class="header-bar">
        <div class="titulo-area">
            <h2>🛍️ Produtos Cadastrados</h2>
            <p>Todos os itens salvos no catálogo</p>
        </div>
        <a href="cadprod.php" class="btn-novo">+ Novo Produto</a>
    </div>

    <?php if ($resultado && $resultado->num_rows > 0): ?>
        <div class="grid-produtos">
            <?php while ($produto = $resultado->fetch_assoc()): ?>
                <div class="card-produto">

                    <?php if (!empty($produto['imagem']) && file_exists(__DIR__ . '/uploads/' . $produto['imagem'])): ?>
                        <img class="imagem-produto"
                             src="uploads/<?php echo htmlspecialchars($produto['imagem']); ?>"
                             alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                    <?php else: ?>
                        <div class="imagem-placeholder">🖼️</div>
                    <?php endif; ?>

                    <div class="info-produto">
                        <span class="categoria-tag"><?php echo htmlspecialchars($produto['categoria']); ?></span>
                        <div class="nome-produto"><?php echo htmlspecialchars($produto['nome']); ?></div>
                        <div class="preco-produto"><?php echo htmlspecialchars($produto['preco']); ?></div>
                    </div>

                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="estado-vazio">
            <div class="icone">📦</div>
            <strong style="color: var(--color-primary);">Nenhum produto cadastrado ainda</strong>
            <p>Clique em "Novo Produto" para começar</p>
        </div>
    <?php endif; ?>

</div>
</body>
</html>