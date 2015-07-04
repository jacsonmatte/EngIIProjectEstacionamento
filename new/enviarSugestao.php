<?php

if(isset($_POST["btnEnviar"])){
    
$nome_remetente = $_POST['txtNome'];
$cidade_remetente = $_POST['txtIdade'];
$email_remetente = $_POST['txtEmail'];
$descricao_remetente = $_POST['txtDescricao'];


$user = "controlparking01@gmail.com";
$pass= "controlparking01";


 //echo "<script language=javascript>alert( $nome_remetente, $cidade_remetente, $email_remetente, $descricao_remetente);</script>";
  require 'PHPMailer/class.smtp.php';
 require 'PHPMailer/class.phpmailer.php';


$mail = new PHPMailer();

$mail->Username = "$user"; // Usuário do servidor SMTP
$mail->Password = "$pass"; // Senha do servidor SMTP

$mail->IsSMTP(); // Define que a mensagem será SMTP
//$mail->SMTPSecure  =  "ssl" ;
//$mail->Host = "smtp.gmail.com"; // Endereço do servidor SMTP (mudar o dominio EX: smtp.dominio.com)
$mail->Host = 'ssl://smtp.gmail.com';
$mail->SMTPAuth = true; // Usa autenticação SMTP? (opcionals
$mail->SMTP_PORT = 465;  
$mail-> SMTPDebug = 2;



$mail->From ='controlparking01@gmail.com';
//$mail->From = "$email_remetente"; // Seu e-mail
$mail->FromName = "$nome_remetente"; // Seu nome

$mail->AddAddress("$user");


$mail->IsHTML(true); // Define que o e-mail será enviado como HTML

$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)




$quebra = "<br>"; 

$mail->Subject  = "Segestão/Crítica/Dúvida"; // Assunto da mensagem
$mail->Body = "$descricao_remetente";
$mail->Body .= $quebra; 


$enviado = $mail->Send();


$mail->ClearAllRecipients();
$mail->ClearAttachments();


if (!$enviado){
     echo "Erro de envio: " . $mail->ErrorInfo;
}else{
    echo "Mensagem enviada com sucesso!";
}

}