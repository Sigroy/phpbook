<?php
declare(strict_types=1);

use PhpAndMysqlBook\Validate\Validate;

require '../bootstrap.php';

$errors = [];

$token = $_GET['token'];

if (!$token) {
    redirect('login.php', ['warning' => 'Link expired, try again.']);
}

$id = $cms->getToken()->getMemberId($token, 'password-reset');
if (!$id) {
    redirect('login.php', ['warning' => 'Link expired, try again.']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    $errors['password'] = Validate::isPassword($password) ? '' : 'Passwords must be at least 8 characters and have:<br> 
                A lowercase letter<br>An uppercase letter<br>A number 
                <br>And a special character';
    $errors['confirm'] = ($confirm === $password) ? '' : 'Passwords do not match';

    $invalid = implode($errors);

    if ($invalid) {
        $errors['message'] = 'Please enter a valid password';
    } else {
        $cms->getMember()->passwordUpdate($id, $password);
        $member = $cms->getMember()->get($id);
        $subject = 'Password Updated';
        $body = 'Your password was updated on ' . date('Y-m-d H:i:s') .
            ' - if you did not reset the password, email ' . $email_config['admin_email'];
        $email = new PhpAndMysqlBook\Email\Email($email_config);
        $email->sendEmail($member['email'], $email_config['admin_email'], $subject, $body);
        redirect('login.php', ['success' => 'Password updated']);
    }
}

$data['navigation'] = $cms->getCategory()->getAll();
$data['errors'] = $errors;
$data['token'] = $token;

echo $twig->render('password-reset.html', $data);