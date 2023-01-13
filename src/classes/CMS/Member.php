<?php

namespace PhpAndMysqlBook\CMS;

class Member
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create(array $member): bool
    {
        $member['password'] = password_hash($member['password'], PASSWORD_DEFAULT);
        try {
            $sql = "INSERT INTO member (forename, surname, email, password)
                    VALUES (:forename, :surname, :email, :password);";
            $result = $this->db - runSql($sql, $member);
            return true;
        } catch (\PDOException $e) {
            if ($e->errorInfo[1] === 1062) {
                return false;
            }
            throw $e;
        }
    }

    public function login($email, $password): array|false
    {
        $sql = "SELECT id, forename, joined, email, password, picture role
                FROM member
                WHERE email = :email;";
        $member = $this->db->runSql($sql, ['email' => $email]);
        if (!$member) {
            return false;
        }
        $authenticated = password_verify($password, $member['password']);
        return ($authenticated ? $member : false);
    }
}