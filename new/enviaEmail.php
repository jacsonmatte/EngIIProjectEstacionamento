<?php
// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
require_once("PHPMailer/class.phpmailer.php");

// Inicia a classe PHPMailer
$mail = new PHPMailer();

// Define os dados do servidor e tipo de conexão
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsSMTP(); // Define que a mensagem será SMTP
$mail->Host = "smtp.dominio.net"; // Endereço do servidor SMTP
//$mail->SMTPAuth = true; // Usa autenticação SMTP? (opcional)
//$mail->Username = 'seumail@dominio.net'; // Usuário do servidor SMTP
//$mail->Password = 'senha'; // Senha do servidor SMTP

// Define o remetente
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->From = "wagnerfrana94@gmail.com"; // Seu e-mail
$mail->FromName = "Control Parking"; // Seu nome

// Define os destinatário(s)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->AddAddress('$email', '$nome');
$mail->AddAddress('$email');
//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta

// Define os dados técnicos da Mensagem
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
//$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)

// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->Subject  = "Envio da nova senha Control Parking"; // Assunto da mensagem
$mail->Body = "Control Parking : Nova Senha" .'$nova_senha'."<b>HTML</b>!  :)";
$mail->AltBody = "Este é o corpo da mensagem de teste, em Texto Plano! \r\n :)";

// Define os anexos (opcional)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo

// Envia o e-mail
$enviado = $mail->Send();

// Limpa os destinatários e os anexos
$mail->ClearAllRecipients();
$mail->ClearAttachments();

// Exibe uma mensagem de resultado
if ($enviado) {
 	echo "<script language=javascript>alert( 'Email Enviado Com Sucesso Com a Nova Senha !' );</script>";
	echo("<script type='text/javascript'>location.href='index.html';</script>");
} else {
  	echo "<script language=javascript>alert( 'Nao foi Possivel enviar o Email' );</script>";
	echo("<script type='text/javascript'>location.href='index.html';</script>");
  	echo "<b>Informações do erro:</b> " . $mail->ErrorInfo;
}