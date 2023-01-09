<?php
declare(strict_types=1);
require 'src/bootstrap.php';

$user_role = 'admin';

is_admin($user_role);

echo '<h1>Welcome admin</h1>';

$exception = false;

if ($exception === true) {
    throw new Exception('The exception is true.');
}

$some_array = ['a', 'b', 'c'];
//echo $some_array[3];

