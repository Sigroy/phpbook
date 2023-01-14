<?php

namespace PhpAndMysqlBook\CMS;

class Token
{
    protected Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function create(int $id, string $purpose)
    {
        $arguments['token'] = bin2hex(random_bytes(64));
        $arguments['expires'] = date('Y-m-d H:i:s', strtotime('+4 hours'));
        $arguments['member_id'] = $id;
        $arguments['purpose'] = $purpose;

        $sql = "INSERT INTO token (token, member_id, expires, purpose)
                VALUES (:token, :member_id, :expires, :purpose);";
        $this->db->RunSql($sql, $arguments);
        return $arguments['token'];
    }

    public function getMemberId(string $token, string $purpose)
    {
        $arguments = ['token' => $token, 'purpose' => $purpose];
        $sql = "SELECT member_id FROM token WHERE token = :token
                AND purpose = :purpose AND expires > NOW();";
        return $this->db->RunSql($sql, $arguments)->fetchColumn();
    }
}