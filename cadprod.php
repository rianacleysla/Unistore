<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="padding: 60px 40px;">

    <h2 style="font-family:'Cinzel',serif; color:#8b3a62; margin-bottom:30px;">Cadastrar novo produto</h2>

    <form action="salvarprod.php" method="POST" style="max-width:400px; display:flex; flex-direction:column; gap:15px;">

        <label>Nome do produto</label>
        <input type="text" name="nome" required style="padding:10px; border-radius:8px; border:1px solid #8b3a62;">

        <label>Preço (ex: 15.90)</label>
        <input type="number" step="0.01" name="preco" required style="padding:10px; border-radius:8px; border:1px solid #8b3a62;">

        <label>URL da imagem</label>
        <input type="text" name="imagem" required style="padding:10px; border-radius:8px; border:1px solid #8b3a62;">

        <button type="submit" class="btn btn-register" style="border:none; cursor:pointer;">Cadastrar</button>

    </form>

</body>
</html>