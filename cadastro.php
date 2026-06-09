<html>
<head>
    <title>Cadastro</title>

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
        margin:190 auto 20px auto;
        width:350px;
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

    </style>
</head>

<body>

<div class="container">

    <img src="logo.png" alt="Logo" class="logo">

    <h2>CADASTRO DE USUÁRIOS</h2>

    <form method="post">

        <label>Nome:</label>
        <input name="nome" type="text" required>

        <label>E-mail ou telefone:</label>
        <input name="email_tel" type="text" required>

        <label>CPF:</label>
        <input name="cpf" type="text" required>

        <label>Data de nascimento:</label>
        <input name="data_nasc" type="date" required>

        <label>Senha:</label>
        <input type="password" name="senha" required>

        <label>CEP:</label>
        <input type="text" name="cep" required>

        <button type="submit" name="inserir">
            CADASTRAR
        </button>

    </form>

<?php

include "conexao.php";

/* =========================
   VALIDAR CPF
========================= */

function validarCPF($cpf){

    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    if(strlen($cpf) != 11){
        return false;
    }

    if(preg_match('/(\d)\1{10}/', $cpf)){
        return false;
    }

    for ($t = 9; $t < 11; $t++) {

        $soma = 0;

        for ($i = 0; $i < $t; $i++) {
            $soma += $cpf[$i] * (($t + 1) - $i);
        }

        $digito = ((10 * $soma) % 11) % 10;

        if ($cpf[$t] != $digito) {
            return false;
        }
    }

    return true;
}

/* =========================
   CADASTRAR
========================= */

if(isset($_POST['inserir'])){

    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $email_tel = mysqli_real_escape_string($conexao, $_POST['email_tel']);
    $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
    $data_nasc = mysqli_real_escape_string($conexao, $_POST['data_nasc']);
    $senha = $_POST['senha'];
    $cep = mysqli_real_escape_string($conexao, $_POST['cep']);

    /* =========================
       VALIDAR SENHA
    ========================= */

    $senhavalida = preg_match(
        '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/',
        $senha
    );

    /* =========================
       VALIDAR EMAIL
    ========================= */

    $emailvalido = filter_var($email_tel, FILTER_VALIDATE_EMAIL);

    /* =========================
       VALIDAR TELEFONE
    ========================= */

    $somenteNumerosTel = preg_replace('/[^0-9]/', '', $email_tel);

    $telefonevalido = (
        strlen($somenteNumerosTel) >= 10 &&
        strlen($somenteNumerosTel) <= 11
    );

    /* =========================
       VALIDAR CPF
    ========================= */

    $somenteNumerosCPF = preg_replace('/[^0-9]/', '', $cpf);

    $cpfvalido = validarCPF($somenteNumerosCPF);

    /* =========================
       VERIFICAR EMAIL DUPLICADO
    ========================= */

    $verificaEmail = mysqli_query(
        $conexao, "SELECT * FROM cadastro WHERE email_tel = '$email_tel'"
    );

    $emailExiste = mysqli_num_rows($verificaEmail);

    /* =========================
       VERIFICAR CPF DUPLICADO
    ========================= */

    $verificaCPF = mysqli_query(
        $conexao,
        "SELECT * FROM cadastro"
    );

    $cpfExiste = false;

    while($usuario = mysqli_fetch_assoc($verificaCPF)){

        if(password_verify($somenteNumerosCPF, $usuario['cpf'])){
            $cpfExiste = true;
            break;
        }
    }

    /* =========================
       VALIDAÇÕES
    ========================= */

    if(!$senhavalida){

        echo "
        <div class='mensagem'>
            A senha deve conter:
            <br><br>
            • 8 caracteres
            <br>
            • letra maiúscula
            <br>
            • letra minúscula
            <br>
            • número
            <br>
            • símbolo
        </div>";

    }

    elseif(!$cpfvalido){

        echo "
        <div class='mensagem'>
            CPF inválido!
        </div>";

    }

    elseif(!$emailvalido && !$telefonevalido){

        echo "
        <div class='mensagem'>
            E-mail ou telefone inválido!
        </div>";

    }

    elseif($emailExiste){

        echo "
        <div class='mensagem'>
            Este e-mail/telefone já está cadastrado!
        </div>";

    }

    elseif($cpfExiste){

        echo "
        <div class='mensagem'>
            Este CPF já está cadastrado!
        </div>";

    }

    else{

        /* =========================
           CRIPTOGRAFAR SENHA
        ========================= */

        $senha_crip = password_hash($senha, PASSWORD_DEFAULT);

        /* =========================
           CRIPTOGRAFAR CPF
        ========================= */

        $cpf_crip = password_hash($somenteNumerosCPF, PASSWORD_DEFAULT);

        /* =========================
           INSERT
        ========================= */

        $sql = mysqli_query($conexao,
        "INSERT INTO cadastro
        (nome, email_tel, cpf, data_nasc, senha, cep)

        VALUES

        ('$nome',
        '$email_tel',
        '$cpf_crip',
        '$data_nasc',
        '$senha_crip',
        '$cep')");

        if($sql){

            echo "
            <div class='mensagem'>
                Cadastro realizado com sucesso!
            </div>";

            echo "
            <script>
                setTimeout(function(){
                    window.location='inicio.php';
                }, 2000);
            </script>";

        } else {

            echo "
            <div class='mensagem'>
                Erro ao cadastrar:
                ".mysqli_error($conexao)."
            </div>";
        }
    }
}

?>

</div>

</body>
</html>