<?php

session_start();

include "conexao.php";

$msg = "";

if(isset($_POST['login'])) {

    $email_tel = trim($_POST['email_tel']);
    $senha = trim($_POST['senha']);

    $email_tel = mysqli_real_escape_string($conexao, $email_tel);

    $sql = mysqli_query($conexao,
    "SELECT * FROM cadastro WHERE email_tel='$email_tel'");

    if(mysqli_num_rows($sql) > 0) {

        $dados = mysqli_fetch_assoc($sql);

        if(password_verify($senha, $dados['senha'])) {

            $_SESSION['vendedor_id'] = $dados['id'];
            $_SESSION['vendedor_nome'] = $dados['nome'];

            header("Location: painel.php");
            exit;

        } else {
            $msg = "Senha incorreta.";
        }

    } else {
        $msg = "Usuário não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>

<style>

*{
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
}

.container{
    width:400px;
    background:white;
    padding:35px;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
}

.logo{
    display:block;
    margin:0 auto 15px auto;
    width:300px; /* ajuste o tamanho se desejar */
    height:auto;
}

h2{
    text-align:center;
    color:#8b3a62;
    margin-bottom:25px;
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
}

input{
    padding:12px;
    border-radius:12px;
    border:1px solid #f8c8dc;
    outline:none;
    transition:0.3s;
}

input:focus{
    border-color:#d63384;
    box-shadow:0 0 8px rgba(214,51,132,0.3);
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

.footer-link{
    margin-top:20px;
    text-align:center;
    color:#8b3a62;
    font-size:14px;
}

.footer-link a{
    color:#d63384;
    font-weight:bold;
    text-decoration:none;
    transition:0.3s;
}

.footer-link a:hover{
    color:#c2186a;
    text-decoration:underline;
}

.esqueci-senha{
    margin-top:12px;
    text-align:center;
}

.esqueci-senha a{
    color:#8b3a62;
    font-size:14px;
    text-decoration:none;
    transition:0.3s;
    font-weight: bold;
}

.esqueci-senha a:hover{
    color:#d63384;
    text-decoration:underline;
}

</style>
</head>

<body>

<div class="container">

   <form method="POST">

    <img src="logo.png" alt="Logo" class="logo">

    <h2>LOGIN</h2>

    <label>E-mail ou telefone:</label>
    <input
        type="text"
        name="email_tel"
        required
    >

    <label>Senha:</label>
    <input
        type="password"
        name="senha"
        required
    >

    <button type="submit" name="login">
        ENTRAR
    </button>

    <?php
    if(!empty($msg)){
        echo "<div class='mensagem'>$msg</div>";
    }
    ?>

    
    <p class="esqueci-senha">
    <a href="alterarsenha.php">Esqueci minha senha</a>
    </p>

    <p class="footer-link">
    Não tem conta?
    <a href="cadastro.php">Cadastre-se</a>
    </p>


</form>

</div>

</body>
</html>