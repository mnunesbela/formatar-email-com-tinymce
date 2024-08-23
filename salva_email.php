<?php
session_start();


    require_once '../lib/PHPMailer/src/PHPMailer.php';
    require_once '../lib/PHPMailer/src/SMTP.php';
    require_once '../lib/PHPMailer/src/Exception.php';

    // Certifique-se de que as instruções 'use' estão fora de qualquer função ou bloco de código
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    function enviarEmailVerificacao($email, $assunto, $mensagem) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'email do destinatario';  // Verifique o e-mail correto
            $mail->Password = '1111 2222 3333 4444';  // Verifique a senha correta
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('email do destinatario');

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {  // Valida o e-mail
                $mail->addAddress($email);
            } else {
                throw new Exception("Endereço de e-mail inválido.");
            }

            $mail->isHTML(true);
            $mail->Subject = $assunto;
            $mail->Body = $mensagem;

            $mail->send();
            $_SESSION['mensagem'] = 'E-mail enviado com sucesso!';
        } catch (Exception $e) {
            $_SESSION['mensagem'] = 'Erro ao enviar e-mail: ' . $e->getMessage();
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = trim($_POST['para']);  // Captura o e-mail
        $assunto = $_POST['assunto'];
        $mensagem = $_POST['mensagem'];

        enviarEmailVerificacao($email, $assunto, $mensagem);
        header('Location: index.php');
        exit();
    }

?>
