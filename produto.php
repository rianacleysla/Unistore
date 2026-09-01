<?php
// Dados dinâmicos do produto
$produto = [
    'id' => 10058687970,
    'nome' => 'Escova de cabelo',
    'marca' => 'VIZZY JEANS',
    'preco_antigo' => 149.99,
    'preco_atual' => 89.99,
    'desconto' => 40,
    'parcelas' => 5,
    'valor_parcela' => 18.00,
    'imagem_principal' => 'https://via.placeholder.com/500x650', // Substitua pelo caminho da sua imagem
    'logo_marca' => 'logo.png', // Caminho da imagem local logo.png
    'cor_nome' => 'Preto',
    'tamanhos' => [
        '36' => true,
        '38' => true,
        '40' => true,
        '42' => true,
        '44' => true,
        '46' => false
    ]
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($produto['nome']); ?> | Loja</title>

    <!-- Importação das fontes Google (Playfair Display para o título e Montserrat para o preço) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,400&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #ffe6f2, #ffd6eb);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* CONTAINER PRINCIPAL (ESTILO DO CARD) */
        .container {
            width: 100%;
            max-width: 900px;
            background: white;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 35px;
        }

        /* LADO ESQUERDO: GALERIA DE IMAGENS */
        .galeria-container {
            position: relative;
            background: #ffe6f2;
            border-radius: 15px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 420px;
            border: 1px solid #f8c8dc;
        }

        .imagem-principal {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .badge-desconto {
            position: absolute;
            top: 15px;
            left: 15px;
            background: #2ecc71;
            color: white;
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: bold;
            z-index: 2;
        }

        .btn-icon {
            position: absolute;
            right: 15px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid #f8c8dc;
            background: white;
            color: #8b3a62;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            cursor: pointer;
            font-size: 16px;
            z-index: 2;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-icon:hover {
            transform: scale(1.08);
            border-color: #d63384;
            color: #d63384;
        }

        .btn-icon.favoritar { top: 15px; }
        .btn-icon.zoom { top: 60px; }

        .seta-galeria {
            position: absolute;
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid #f8c8dc;
            font-size: 22px;
            color: #8b3a62;
            cursor: pointer;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            z-index: 2;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .seta-galeria:hover {
            background: white;
            color: #d63384;
            border-color: #d63384;
        }

        .seta-galeria.anterior { left: 12px; }
        .seta-galeria.proximo { right: 12px; }

        /* LADO DIREITO: INFORMAÇÕES DO PRODUTO */
        .detalhes-info {
            display: flex;
            flex-direction: column;
        }

        /* ESTILO DA LOGO ACIMA DO TÍTULO */
        .logo-produto {
            max-width: 80px;
            max-height: 35px;
            width: auto;
            height: auto;
            object-fit: contain;
            margin-bottom: 8px;
            display: block;
        }

        /* FONTE DO NOME DO PRODUTO MODIFICADA */
        h2 {
            text-align: left;
            color: #8b3a62;
            margin-bottom: 10px;
            font-size: 28px;
            line-height: 1.25;
            font-family: 'Playfair Display', Georgia, serif;
            font-weight: 700;
            letter-spacing: -0.3px;
        }

        .sku {
            font-size: 12px;
            color: #b05c85;
            margin-bottom: 12px;
            font-weight: 600;
        }

        .avaliacao {
            font-size: 13px;
            margin-bottom: 18px;
        }

        .estrelas {
            color: #f8c8dc;
            margin-right: 6px;
        }

        .link-avaliacao {
            color: #8b3a62;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
        }

        .link-avaliacao:hover {
            color: #d63384;
            text-decoration: underline;
        }

        .bloco-preco {
            margin-bottom: 15px;
        }

        .preco-antigo {
            text-decoration: line-through;
            color: #aaa;
            font-size: 15px;
        }

        /* COR DO PREÇO ATUALIZADA PARA PRETO E FONTE DESTACADA */
        .preco-atual {
            color: #1a1a1a;
            font-size: 32px;
            font-weight: 700;
            font-family: 'Montserrat', 'Segoe UI', sans-serif;
            letter-spacing: -0.5px;
        }

        .parcelamento {
            display: block;
            color: #b05c85;
            font-size: 13px;
            font-weight: 600;
        }

        .vendedor {
            font-size: 13px;
            color: #666;
            margin-bottom: 20px;
        }

        /* OPÇÕES DE SELEÇÃO */
        label {
            margin-top: 10px;
            margin-bottom: 6px;
            color: #8b3a62;
            font-weight: 600;
            font-size: 14px;
            display: block;
        }

        .opcao-secao {
            margin-bottom: 15px;
        }

        .thumb-cor {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 2px solid #f8c8dc;
            padding: 2px;
            cursor: pointer;
            background: none;
            transition: 0.3s;
        }

        .thumb-cor.ativo, .thumb-cor:hover {
            border-color: #d63384;
        }

        .thumb-cor img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .grade-tamanhos {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-tamanho {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            border: 1px solid #f8c8dc;
            background: white;
            color: #8b3a62;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-tamanho.ativo, .btn-tamanho:hover:not(.indisponivel) {
            border-color: #d63384;
            background: #ffe6f2;
            color: #d63384;
        }

        .btn-tamanho.indisponivel {
            color: #ccc;
            border-color: #eee;
            text-decoration: line-through;
            cursor: not-allowed;
            background: #fafafa;
        }

        .links-auxiliares {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .links-auxiliares a {
            color: #d63384;
            font-size: 13px;
            font-weight: bold;
            text-decoration: none;
            transition: 0.3s;
        }

        .links-auxiliares a:hover {
            color: #c2186a;
            text-decoration: underline;
        }

        /* FORMULÁRIO E SELETOR DE QUANTIDADE */
        form {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .quantidade-secao {
            margin-bottom: 20px;
        }

        .seletor-quantidade {
            display: flex;
            align-items: center;
            border: 1px solid #f8c8dc;
            border-radius: 12px;
            width: fit-content;
            overflow: hidden;
            background: #fff;
        }

        .btn-qtd {
            background: #ffe6f2;
            border: none;
            color: #8b3a62;
            font-size: 18px;
            font-weight: bold;
            width: 38px;
            height: 38px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-qtd:hover {
            background: #ffd6eb;
            color: #d63384;
        }

        .seletor-quantidade input[type="number"] {
            width: 45px;
            height: 38px;
            border: none;
            text-align: center;
            font-size: 15px;
            font-weight: bold;
            color: #8b3a62;
            padding: 0;
            -moz-appearance: textfield;
        }

        .seletor-quantidade input::-webkit-outer-spin-button,
        .seletor-quantidade input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* GRUPO DE BOTÕES */
        .botoes-acao {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 10px;
        }

        button {
            margin-top: 0;
            padding: 12px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            width: 100%;
            text-align: center;
        }

        /* BOTÃO COMPRAR AGORA (ESTILO PRINCIPAL) */
        .btn-comprar-agora {
            background: #d63384;
            color: white;
        }

        .btn-comprar-agora:hover {
            background: #c2186a;
            transform: scale(1.03);
        }

        /* BOTÃO ADICIONAR AO CARRINHO (ESTILO SECUNDÁRIO VAZADO) */
        .btn-add-carrinho {
            background: white;
            color: #d63384;
            border: 2px solid #d63384;
        }

        .btn-add-carrinho:hover {
            background: #ffe6f2;
            transform: scale(1.03);
        }

        /* RESPONSIVIDADE */
        @media(max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
                padding: 25px;
            }

            .galeria-container {
                min-height: 320px;
            }
        }
    </style>
</head>
<body>

<main class="container">    
  <div class="galeria-container">
    <img src="<?= htmlspecialchars($produto['imagem_principal']); ?>" alt="<?= htmlspecialchars($produto['nome']); ?>" class="imagem-principal">
  </div>

  <!-- INFORMAÇÕES DO PRODUTO -->
  <div class="detalhes-info">
    <!-- LOGO APONTANDO PARA logo.png -->
    <img src="<?= htmlspecialchars($produto['logo_marca']); ?>" alt="<?= htmlspecialchars($produto['marca']); ?>" class="logo-produto">

    <h2><?= htmlspecialchars($produto['nome']); ?></h2>

    <div class="bloco-preco">
      <div class="preco-atual">R$ <?= number_format($produto['preco_atual'], 2, ',', '.'); ?></div>
    </div>

    <div class="vendedor">Vendido e entregue por: <strong>UNISTORE</strong></div>

    <!-- FORMULÁRIO DE COMPRA -->
    <form action="checkout.php" method="POST">
        <input type="hidden" name="produto_id" value="<?= $produto['id']; ?>">
        
        <div class="opcao-secao quantidade-secao">
            <label>Quantidade:</label>
            <div class="seletor-quantidade">
                <button type="button" class="btn-qtd" onclick="alterarQtd(-1)">-</button>
                <input type="number" id="quantidade" name="quantidade" value="1" min="1" max="99" readonly>
                <button type="button" class="btn-qtd" onclick="alterarQtd(1)">+</button>
            </div>
        </div>

        <div class="botoes-acao">
            <button type="submit" name="acao" value="comprar_agora" class="btn-comprar-agora">Comprar Agora</button>
            <button type="submit" name="acao" value="adicionar_carrinho" class="btn-add-carrinho">Adicionar ao Carrinho</button>
        </div>
    </form>
  </div>
</main>

<script>
function alterarQtd(valor) {
    const input = document.getElementById('quantidade');
    let qtdAtual = parseInt(input.value) || 1;
    qtdAtual += valor;
    if (qtdAtual >= 1 && qtdAtual <= 99) {
        input.value = qtdAtual;
    }
}
</script>

</body>
</html>