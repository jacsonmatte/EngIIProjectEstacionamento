<?php

if(isset($_POST["btnEnviar"])){
    
	$nome_remetente = $_POST['txtNome'];
	$cidade_remetente = $_POST['txtIdade'];
	$email_remetente = $_POST['txtEmail'];
	$descricao_remetente = $_POST['txtDescricao'];

	if($nome_remetente==""){ // não informou o nome
		echo "<script language=javascript>alert( 'Por favor preencha o seu Nome.' );</script>";
		echo("<script type='text/javascript'>location.href='ajuda.php';</script>");
	}
	elseif ($cidade_remetente=="") { //não informou cidade
		echo "<script language=javascript>alert( 'Por favor preencha o sua cidade.' );</script>";
		echo("<script type='text/javascript'>location.href='ajuda.php';</script>");
	}
	elseif ($email_remetente=="") { // não informou e-mail
		echo "<script language=javascript>alert( 'Por favor preencha o seu e-mail.' );</script>";
		echo("<script type='text/javascript'>location.href='ajuda.php';</script>");
	}
	elseif ($descricao_remetente=="") { // nao informou  a descrição
		echo "<script language=javascript>alert( 'Por favor preencha a descricao.' );</script>";
		echo("<script type='text/javascript'>location.href='ajuda.php';</script>");
	}

	else{   // todos os capos preenchidos, então inicia o envio do e-mail.

			$user = "controlparking01@gmail.com";
			$pass = "controlparking01";

			require 'PHPMailer/class.phpmailer.php';

			$mail = new PHPMailer();


			$remetente = "controlparking01@gmail.com"; // Aqui vai do email remetente o qual aparecerá no e-mail enviado;
			$senharemetente = "controlparking"; // senha da conta de e-mail do remetente;


			// ======DADOS DO SERVIDOR E AS CONEXÕES==================================

			$mail->IsSMTP(); // Define que a mensagem será SMTP
			$mail->SMTPSecure  =  "tls" ;
			$mail->Host = "smtp.gmail.com"; // Endereço do servidor SMTP (mudar o dominio EX: smtp.dominio.com)
			$mail->SMTPAuth = true; // Autenticação SMTP
			$mail->SMTP_PORT = 465;  // Portas de envio
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

			$mail->Subject  = "Sugestão/Crítica/Dúvida"; // Assunto da mensagem
			//=================CORPO DO E-MAIL========================================
			$mail->Body = "Você recebeu uma Sugestão/Crítica/Dúvida!";
			$mail->Body .= "<p>";
			$mail->Body .= $quebra; 
			$mail->Body .= "E-mail enviado por: " . $nome_remetente;
			$mail->Body .= $quebra; 
			$mail->Body .= "De: " . $cidade_remetente;
			$mail->Body .= $quebra;
			$mail->Body .= "E-mail: " . $email_remetente ;
			$mail->Body .= $quebra;
			$mail->Body .= "<p>";
			$mail->Body .= "Descrição: " . $descricao_remetente ;
			$mail->Body .= $quebra;


			$enviado = $mail->Send(); // enviando o e-mail

			//=============LIMPA DESTINATARIOS E TEXTO=================================
				$mail->ClearAllRecipients();
				$mail->ClearAttachments();

		if (!$enviado){ // testa se o e-mail foi enviado
		   	echo "<script language=javascript>alert( 'Nao foi Possivel enviar a sua sugestao, tente mais tarde !!! ' );</script>";
			echo("<script type='text/javascript'>location.href='ajuda.php';</script>");
		}else{
		    echo "<script language=javascript>alert( 'Sua sugestao foi enviada com sucesso!' );</script>";
				echo("<script type='text/javascript'>location.href='ajuda.php';</script>");
		}
	}
}