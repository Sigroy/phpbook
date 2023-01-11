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
}

$data['member'] = $member;
$data['errors'] = $errors;

echo $twig->render('register.html', $data);