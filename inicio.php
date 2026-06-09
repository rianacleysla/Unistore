<!DOCTYPE html>
<html lang="pt-br">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Unistore</title>

<!-- FONTES -->
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

<style>

html{
    scroll-behavior:smooth;
}

/* RESET */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

/* BODY */
body{
    background:#fff7fb;
    font-family:'Poppins', sans-serif;
    overflow-x:hidden;
}

/* NAVBAR */
header{
    width:100%;
    height:80px; /* altura fixa */
    padding:0 50px;

    display:flex;
    justify-content:space-between;
    align-items:center;

    background:rgba(255, 214, 234, 0.88);
    backdrop-filter:blur(14px);
    border-bottom:1px solid rgba(255,255,255,0.4);

    position:fixed;
    top:0;
    z-index:1000;
}

/* LOGO */
.logo{
    font-family:'Cinzel', serif;
    font-size:34px;
    color:#8b3a62;
    letter-spacing:2px;

    display:flex;
    align-items:center;
    gap:12px;
}

.logo{
    display:flex;
    align-items:center;
    gap:12px;
    overflow:visible;
}

.logo-img{
    width:250px;
    height:250px;
    object-fit:contain;
    position:relative;
    top:40px;
}

/* MENU */
nav a {
    text-decoration: none;
    margin: 0 15px;
    color: #8b3a62;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;        /* deixa mais bold, igual aos cards */
    font-size: 17px;
    letter-spacing: 0.5px;
    transition: 0.3s;
    position: relative;
}

nav a:hover {
    color: #d63384;
}

nav a{
    text-decoration:none;
    margin:0 15px;
    color:#8b3a62;
    font-weight:500;
    transition:0.3s;
    position:relative;
}

nav a:hover{
    color:#d63384;
}

/* BOTÕES HEADER */
.buttons{
    display:flex;
    gap:12px;
}

.btn{
    padding:12px 22px;
    border-radius:30px;
    text-decoration:none;
    transition:0.3s;
    font-size:14px;
    font-weight:500;
}

/* LOGIN */
.btn-login {
    border: 1.5px solid #c76b96;
    color: #8b3a62;
    background: white;
    display: flex;
    align-items: center;
    gap: 7px;
    box-shadow: 0 2px 10px rgba(139,58,98,0.12);
    letter-spacing: 0.3px;
}

.btn-login:hover {
    background: #8b3a62;
    color: white;
    border-color: #8b3a62;
    box-shadow: 0 6px 18px rgba(139,58,98,0.28);
    transform: translateY(-2px);
}

/* CRIAR CONTA — mesmo gradiente do botão hero */
.btn-register {
    background: linear-gradient(135deg, #ff4fa3, #ff85c2, #ffd6a5);
    color: white;
    box-shadow: 0 6px 18px rgba(255,79,163,0.35);
    border: none;
}

.btn-register:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 10px 25px rgba(255,79,163,0.5);
}

/* HERO */
.hero{
    height:100vh;

    background:
        linear-gradient(
            rgba(255,255,255,0.08),
            rgba(255,255,255,0.15)
        ),
        url("unicorniocerto.png");

    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;

    display:flex;
    justify-content:center;
    align-items:center;
    text-align:center;

    position:relative;
}

.hero::before{
    content:"";
    position:absolute;
    inset:0;

    background:
        radial-gradient(
            circle at center,
            rgba(255,255,255,0.15),
            rgba(255,255,255,0)
        );

    pointer-events:none;
}

/* HERO CONTENT */
.hero-content{
    max-width:800px;
    padding:20px;
    position:relative;
    z-index:2;

    display:flex;
    flex-direction:column;
    align-items:center;
}

.hero h1{
    
    font-family:'Cinzel', serif;
    font-size:120px;
    color:white;
    letter-spacing:4px;

    text-shadow:
        0 0 10px rgba(249, 234, 181, 0.92),
        0 0 25px rgba(255, 244, 171, 0.82),
        0 4px 15px rgba(0,0,0,.35);
}

.hero p{
    font-size:24px;
    color:white;
    font-weight:300;
    text-shadow:0 2px 10px rgba(0,0,0,.4);
}

.hero-btn{
    display:inline-block;
    margin-top:10px;

    padding:15px 35px;

    border-radius:50px;
    text-decoration:none;

    background:linear-gradient(
        135deg,
        #ff4fa3,
        #ff85c2,
        #ffd6a5
    );

    color:white;
    font-size:18px;
    font-weight:500;
    letter-spacing:1px;

    box-shadow:
        0 10px 30px rgba(255,79,163,0.35),
        0 0 20px rgba(255,214,165,0.25);

    transition:all .35s ease;
}

.hero-btn:hover{
    transform:translateY(-5px) scale(1.06);

    box-shadow:
        0 15px 35px rgba(255,79,163,0.5),
        0 0 25px rgba(255,214,165,0.4);
}

.hero-btn:hover{
    transform:translateY(-4px) scale(1.05);

    box-shadow:
        0 12px 30px rgba(255,79,163,.6);
}

@media(max-width:768px){

    .hero h1{
        font-size:60px;
    }

    .hero p{
        font-size:18px;
    }
}
.cliente{
    background:linear-gradient(45deg,#ff9ecb,#ff4fa3);
}

.vendedor{
    background:linear-gradient(45deg,#ff006e,#ff2d95);
}

.magic-btn:hover{
    transform:translateY(-5px) scale(1.05);
}

.cadastro-link a{
    text-decoration:none;
    color:#8b3a62;
    font-weight:600;
    font-size:19px;
}

.cadastro-link a:hover{
    color:#d63384;
}

/* TÓPICOS */
.topicos{
    padding:100px 40px;
    text-align:center;
    background:white;
}

.topicos h2{
    font-family:'Cinzel', serif;
    font-size:38px;
    color:#8b3a62;
    margin-bottom:60px;
}

/* CARDS */
.cards{
    display:flex;
    justify-content:center;
    flex-wrap:wrap;
    gap:30px;
}

.card{
    width:260px;
    padding:35px 25px;
    border-radius:25px;
    background:linear-gradient(180deg,#ffe4f3,#fff);
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
    transition:0.4s;
}

.card:hover{
    transform:translateY(-10px);
}

.card h3{
    color:#8b3a62;
    margin-bottom:15px;
}

.card p{
    color:#666;
}

/* PRODUTOS */
.produtos{
    padding:100px 40px;
    background:#fff7fb;
    text-align:center;
}

.produtos h2{
    font-family:'Cinzel', serif;
    font-size:38px;
    color:#8b3a62;
    margin-bottom:10px;
}

/* SUBTÍTULO ALTERADO */
.subtitulo{
    font-family:'Poppins', sans-serif;
    font-size:16px;
    font-weight:400;
    color:#b05c85;
    margin-bottom:50px;
}

/* GRID */
.produtos-container{
    display:grid;
    grid-template-columns:repeat(auto-fit, minmax(230px, 1fr));
    gap:30px;
    max-width:1100px;
    margin:0 auto;
}

/* CARD PRODUTO */
.produto-card{
    background:white;
    border-radius:25px;
    overflow:hidden;
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
    transition:0.4s;
}

.produto-card:hover{
    transform:translateY(-10px);
}

/* IMAGEM */
.produto-img{
    width:100%;
    height:220px;
    background:#ffe4f3;
    overflow:hidden;
}

.produto-img img{
    width:100%;
    height:100%;
    object-fit:cover;
}

/* INFO */
.produto-info{
    padding:22px;
    text-align:left;
}

.produto-info h3{
    color:#8b3a62;
    margin-bottom:8px;
}

.produto-info p{
    color:#666;
    font-size:14px;
    margin-bottom:12px;
}

.preco{
    color:#d63384;
    font-size:20px;
    font-weight:600;
    margin-bottom:18px;
}

/* BOTÃO PRODUTO */
.btn-produto{
    display:inline-block;
    padding:10px 18px;
    border-radius:20px;
    text-decoration:none;
    background:linear-gradient(45deg,#ff4fa3,#ff85c2);
    color:white;
    font-size:14px;
    transition:0.3s;
}

.btn-produto:hover{
    transform:scale(1.05);
    opacity:0.9;
}

/* BOTÃO VER MAIS */
.ver-mais-container{
    margin-top:50px;
    text-align:center;
}

.btn-ver-mais{
    display:inline-block;
    padding:14px 34px;
    border-radius:35px;
    text-decoration:none;
    background:linear-gradient(45deg,#ff4fa3,#ff85c2);
    color:white;
    font-size:16px;
    font-weight:500;
    transition:0.3s;
    box-shadow:0 6px 18px rgba(255,79,163,0.25);
}

.btn-ver-mais:hover{
    transform:translateY(-4px) scale(1.05);
    opacity:0.92;
}

/* FOOTER */
footer{
    padding:8px;
    text-align:center;
    background:white;
    color:#8b3a62;
}

.footer-logo{
    width:180px;
    height:auto;
}

/* RESPONSIVO */
@media(max-width:768px){

    header{
        padding:18px 25px;
        flex-direction:column;
        gap:15px;
    }

    .hero h1{
        font-size:52px;
    }

    .hero p{
        font-size:18px;
    }

    .topicos h2,
    .produtos h2{
        font-size:36px;
    }

}

</style>

</head>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700&family=Poppins:wght@300;400;500&family=Playfair+Display:wght@500;700&display=swap" rel="stylesheet">

<body>

<header>

<div class="logo">
    <img src="logo.png" alt="Logo Unistore" class="logo-img">Unistore</div>

<nav>
    <a href="#sobre">SOBRE NÓS</a>
    <a href="#produtos">PRODUTOS</a>
</nav>

<div class="buttons">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <a href="login.php" class="btn btn-login">
        <i class="ti ti-user"></i> Login
    </a>

    <a href="cadastro.php" class="btn btn-register">
        Criar Conta
    </a>
</div>

</header>

<section class="hero">

    <div class="hero-content">

    <h1>UNISTORE</h1>

    <a href="cadastro.php" class="hero-btn">
        ✨ Criar conta
    </a>

</div>

</section>

</section>

<section class="topicos" id="sobre">

    <h2>POR QUE USAR A UNISTORE?</h2>

    <div class="cards">

        <div class="card">
            <h3>🛍 Produtos</h3>
            <p>Descubra itens mágicos e exclusivos.</p>
        </div>

        <div class="card">
            <h3>🔥 Promoções</h3>
            <p>Aproveite descontos encantadores.</p>
        </div>

        <div class="card">
            <h3>🌙 Comunidade</h3>
            <p>Conheça aventureiros da Unistore.</p>
        </div>

        <div class="card">
            <h3>📦 Pedidos</h3>
            <p>Acompanhe suas compras facilmente.</p>
        </div>

    </div>

</section>

<!-- PRODUTOS -->
<section class="produtos" id="produtos">

    <h2>EXPLORE A MAGIA</h2>

    <p class="subtitulo">
        Navegue por nossos produtos 👇
    </p>

    <div class="produtos-container">

        <!-- PRODUTO 1 -->
        <div class="produto-card">

            <div class="produto-img">
                <img src="produto1.jpeg" alt="Produto 1">
            </div>

            <div class="produto-info">

                <h3>Escova Floral Encantada</h3>

                <p>Escova de madeira pintada à mão com flores delicadas e detalhes inspirados em contos de fadas.</p>

                <div class="preco">R$ 25,00</div>

                <a href="login.php" class="btn-produto">
                    Ver produto
                </a>

            </div>

        </div>

        <!-- PRODUTO 2 -->
        <div class="produto-card">

            <div class="produto-img">
                <img src="produto2.jpeg" alt="Produto 2">
            </div>

            <div class="produto-info">

                <h3>Porta-Joias de cerâmica</h3>

                <p>Pratinho artesanal em tons de rosa, perfeito para guardar anéis, brincos e pequenos acessórios.</p>

                <div class="preco">R$ 95,26</div>

                <a href="login.php" class="btn-produto">
                    Ver produto
                </a>

            </div>

        </div>

        <!-- PRODUTO 3 -->
        <div class="produto-card">

            <div class="produto-img">
                <img src="produto3.jpeg" alt="Produto 3">
            </div>

            <div class="produto-info">

                <h3>Chaveiro Sol Mágico</h3>

                <p>Chaveiro artesanal em formato de sol, ideal para bolsas, mochilas e chaves.</p>

                <div class="preco">R$ 15,00</div>

                <a href="login.php" class="btn-produto">
                    Ver produto
                </a>

            </div>

        </div>

        <!-- PRODUTO 4 -->
        <div class="produto-card">

            <div class="produto-img">
                <img src="produto4.jpeg" alt="Produto 4">
            </div>

            <div class="produto-info">

                <h3>Porta acessórios de cogumelo</h3>

                <p>Organizador de joias decorado com cogumelos encantados, unindo praticidade e fantasia.</p>

                <div class="preco">R$ 86,45</div>

                <a href="login.php" class="btn-produto">
                    Ver produto
                </a>

            </div>

        </div>

    </div>

    <!-- BOTÃO VER MAIS -->
<div class="ver-mais-container">

    <a href="login.php" class="btn-ver-mais">
        ✨ VER MAIS
    </a>

</div>

</section>

<footer>
    <img src="logo.png" alt="Logo Unistore" class="footer-logo">
</footer>

</body>
</html>