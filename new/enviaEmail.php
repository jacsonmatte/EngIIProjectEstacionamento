<?php
// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
require_once("PHPMailer/class.phpmailer.php");

// Inicia a classe PHPMailer
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

$mail->AddAddress("$email");
//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta
// Define os dados técnicos da Mensagem

// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=

$mail->IsHTML(true); // Define que o e-mail será enviado como HTML

$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)


// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$quebra = "<br>"; 

$mail->Subject  = "Redefinição Senha Control Parking"; // Assunto da mensagem
$mail->Body = "Redefinição Senha Control Parking";
$mail->Body .= $quebra; 
$mail->Body .= "Senha enviada em " . date("d/m/Y");
$mail->Body .= $quebra; 
$mail->Body .= $quebra; 
$mail->Body .= "Seguem seus dados abaixo: ";
$mail->Body .= $quebra;
$mail->Body .= $quebra;
$mail->Body .= "Seu login é: " . $login ;
$mail->Body .= $quebra;
$mail->Body .= "Sua nova senha é: " . $nova_senha ;
$mail->Body .= $quebra;
$mail->Body .= $quebra; 
$mail->Body .= "E-mail automático! Não responda este e-mail";

//$mail->AltBody = "Este é o corpo da mensagem de teste, em Texto Plano! \r\n ";

// Define os anexos (opcional)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=

//$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo

// Envia o e-mail
$enviado = $mail->Send();

// Limpa os destinatários e os anexos
$mail->ClearAllRecipients();
$mail->ClearAttachments();
if ($enviado) {
 	echo "<script language=javascript>alert( 'Email Enviado Com Sucesso Com a Nova Senha !' );</script>";
	echo("<script type='text/javascript'>location.href='index.html';</script>");
} else {
  	echo "<script language=javascript>alert( 'Nao foi Possivel enviar o Email' );</script>";
	echo("<script type='text/javascript'>location.href='index.html';</script>");
  	echo "<b>Informações do erro:</b> " . $mail->ErrorInfo;
}

?>