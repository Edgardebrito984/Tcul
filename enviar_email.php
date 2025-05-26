<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Se estiver usando Composer

$mail = new PHPMailer(true);

try {
    $mail->CharSet ='utf-8';
    $mail->Encoding ='base64';
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'ferreiraedgar2022@gmail.com';
    $mail->Password   = 'zkrqdlaiwwihatol'; // senha de aplicativo sem espaços
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('ferreiraedgar2022@gmail.com', ' TCUL');
    $mail->addAddress('edgardebrito5@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = 'Confirmação de Compra';
    $mail->Body    = 'Sua compra foi confirmada. Obrigado por viajar conosco!';
    $mail->AltBody = 'Sua compra foi confirmada.';
   
   

    $mail->send();
    echo 'Email enviado com sucesso';
} catch (Exception $e) {
    echo "Erro ao enviar email: {$mail->ErrorInfo}";
}
?>
