<?php
declare(strict_types=1);

use PhpAndMysqlBook\Validate\Validate;

require '../bootstrap.php';

$error = false;
$sent = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $error = Validate::isEmail($email) ? '' : 'Please enter your email';
    if ($error === '') {
        $id = $cms->getMember()->getIdByEmail($email);
        if ($id) {
            $token = $cms->getToken()->create($id, 'password-reset');
            $link = DOMAIN . DOC_ROOT . 'password_resent.php?token=' . $token;
            $subject = 'Reset Password Link';
            $body = 'To reset password click: <a href="' . $link . '">' . $link . '</a>';
            $mail = new PhpAndMysqlBook\Email\Email($email_config);
            $sent = $mail->sendEmail($email_config['admin_email'], $email, $subject, $body);
        }
    }
}

//$data['navigation'] = $cms->getCategory()->getAll();
$data['error'] = $error ?? null;
$data['sent'] = $sent;

echo $twig->render('password-lost.html', $data);