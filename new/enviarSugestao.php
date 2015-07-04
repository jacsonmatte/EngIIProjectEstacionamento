<?php

if(isset($_POST["btnEnviar"])){
    
$nome_remetente = $_POST['txtNome'];
$cidade_remetente = $_POST['txtIdade'];
$email_remetente = $_POST['txtEmail'];
$descricao_remetente = $_POST['txtDescricao'];

$user = "controlparking01@gmail.com";
$pass = "controlparking01";

require 'PHPMailer/class.phpmailer.php';

$mail = new PHPMailer();


$remetente = "controlparking01@gmail.com"; // Aqui vai do email remetente o qual aparecerá no e-mail enviado;
$senharemetente = "controlparking"; // senha da conta de e-mail do remetente;


// Define os dados do servidor e tipo de conexão
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsSMTP(); // Define que a mensagem será SMTP
$mail->SMTPSecure  =  "tls" ;
$mail->Host = "smtp.gmail.com"; // Endereço do servidor SMTP (mudar o dominio EX: smtp.dominio.com)
$mail->SMTPAuth = true; // Usa autenticação SMTP? (opcional)
$mail->SMTP_PORT = 465;  
$mail->Username = "$remetente"; // Usuário do servidor SMTP
$mail->Password = "$senharemetente"; // Senha do servidor SMTP

// Define o remetente
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=

$mail->From = "$remetente"; // Seu e-mail
$mail->FromName = "Control Parking"; // Seu nome
// Define os destinatário(s)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=

$mail->AddAddress("controlparking01@gmail.com");

$mail->IsHTML(true); // Define que o e-mail será enviado como HTML

$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

$quebra = "<br>"; 

$mail->Subject  = "Segestão/Crítica/Dúvida"; // Assunto da mensagem
$mail->Body .= "$nome_remetente";
$mail->Body .= "$quebra"; 
$mail->Body .= "$cidade_remetente";
$mail->Body .= "$quebra"; 
$mail->Body .= "$email_remetente";
$mail->Body .= "$quebra"; 
$mail->Body = "$descricao_remetente";
$mail->Body .= "$quebra"; 


$enviado = $mail->Send();


$mail->ClearAllRecipients();
$mail->ClearAttachments();

if (!$enviado){
    echo "Erro de envio: ". $mail->ErrorInfo;
}else{
    echo "Mensagem enviada com sucesso!";
}

}