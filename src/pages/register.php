<?php
declare(strict_types=1);

use PhpAndMySqlBook\Validate\Validate;

include '../bootstrap.php';

$member = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $member['forename'] = $_POST['forename'];
    $member['surname'] = $_POST['surname'];
    $member['email'] = $_POST['email'];
    $member['password'] = $_POST['password'];
    $confirm = $_POST['confirm'];

    $errors['forname'] = Validate::isText($member['forename'], 1, 254)
        ? '' : 'Forename must be 1-254 characters';
    $errors['surname'] = Validate::isText($member['surname'], 1, 254)
        ? '' : 'Surname must be 1-254 characters';
    $errors['email'] = Validate::isEmail($member['email']) ? '' : 'Please enter a valid email';
    $errors['password'] = Validate::isPassword($member['password'])
        ? '' : 'Passwords must be at least 8 characters and have:<br>
               A lowercase letter<br>An uppercase letter<br>A number<br>
                And a special character';
    $errors['confirm'] = ($member['password'] === $confirm)
        ? '' : 'Passwords do not match';

    $invalid = implode($errors);

    if (!$invalid) {
        $result = $cms->getMember()->create($member);
        if ($result === false) {
            $errors['email'] = 'Email address already used';
        } else {
            redirect('login.php', ['success' => 'Thanks for joining! Please log in.']);
        }
    }
}

$data['navigation'] = $cms->getCategory()->getAll();
$data['member'] = $member;
$data['errors'] = $errors;

echo $twig->render('register.html', $data);