<?php
declare(strict_types=1);
require 'src/bootstrap.php';

use PhpAndMysqlBook\Validate\Validate;

$user_role = 'admin';

is_admin($user_role);

echo '<h1>Welcome admin</h1>';

$exception = false;

if ($exception === true) {
    throw new Exception('The exception is true.');
}

$some_array = ['a', 'b', 'c'];
//echo $some_array[3];

echo 'Correct number: ';
var_dump(Validate::isNumber(100));
echo '<br>';
echo 'Incorrect number: ';
var_dump(Validate::isNumber(9999));
echo '<br>';
echo 'Correct password: ';
var_dump(Validate::isPassword('Lobos1234'));