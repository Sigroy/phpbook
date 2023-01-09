<?php

namespace PhpAndMysqlBook\Validate;
// Namespace declaration

class Validate
{

    public static function isNumber($number, $min = 0, $max = 100): bool
    {
        return ($number >= $min and $number <= $max);
    }

    public static function isText(string $text, int $min = 0, int $max = 1000): bool
    {
        $length = mb_strlen($text);
        return ($length >= $min and $length <= $max);
    }

    public static function isEmail(string $email): bool
    {
        return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? true : false;
    }

    public static function isPassword($password): bool
    {
        if (mb_strlen($password) >= 8
            and preg_match('/[A-Z]/', $password)
            and preg_match('/[a-z]/', $password)
            and preg_match('/[0-9]/', $password)) {
            return true;
        } else {
            return false;
        }
    }

    public static function isMemberId($member_id, array $member_list): bool
    {
        foreach ($member_list as $member) {
            if ($member['id'] == $member_id) {
                return true;
            }
        }
        return false;
    }

    public static function isCategoryId($category_id, array $category_list): bool
    {
        foreach ($category_list as $category) {
            if ($category['id'] == $category_id) {
                return true;
            }
        }
        return false;
    }

}