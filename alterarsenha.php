<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
set_time_limit(15);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

$mensagem = "";
$classe = "";

try {

    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'lianeivaribeiro@gmail.com';
    $mail->Password   = 'kukpjgyjotspgueo';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    $mail->setFrom('lianeivaribeiro@gmail.com', 'Teste');
    $mail->addAddress('lianeivaribeiro@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = 'Alterar senha';
    $mail->Body    = 'Altere sua senha!';

    $mail->send();

    $mensagem = "E-mail enviado com sucesso!";
    $classe = "sucesso";

} catch (Exception $e) {

    $mensagem = "Erro ao enviar o e-mail: " . $mail->ErrorInfo;
    $classe = "erro";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Alterar Senha</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', sans-serif;
}

body{
    background:linear-gradient(135deg,#ffe6f2,#ffd6eb);
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
}

.container{
    width:450px;
    background:white;
    padding:35px;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
    text-align:center;
}

.logo{
    display:block;
    margin:0 auto 15px auto;
    width:250px;
    height:auto;
}

h2{
    color:#8b3a62;
    margin-bottom:20px;
}

.mensagem{
    padding:15px;
    border-radius:12px;
    font-weight:bold;
    margin-top:15px;
}

.sucesso{
    background:#fce4ef;
    color:#8b3a62;
    border:1px solid #f8c8dc;
}

.erro{
    background:#ffe5e5;
    color:#b22222;
    border:1px solid #ffb6b6;
}

.botao{
    display:inline-block;
    margin-top:20px;
    padding:12px 25px;
    border-radius:25px;
    background:#d63384;
    color:white;
    text-decoration:none;
    font-weight:bold;
    transition:0.3s;
}

.botao:hover{
    background:#c2186a;
    transform:scale(1.03);
}

</style>
</head>
<body>

<div class="container">

    <img src="logo.png" alt="Logo" class="logo">

    <h2>RECUPERAÇÃO DE SENHA</h2>

    <div class="mensagem <?php echo $classe; ?>">
        <?php echo $mensagem; ?>
    </div>

    <a href="login.php" class="botao">
        Voltar para o Login
    </a>

</div>

</body>
</html>