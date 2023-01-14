<?php

namespace PhpAndMysqlBook\CMS;
class CMS
{
    protected $db = null;
    protected $article = null;
    protected $category = null;
    protected $member = null;
    protected $session = null;
    protected $token = null;
    protected $like = null;
    protected $comment = null;

    function __construct(string $dsn, string $username, string $password)
    {
        $this->db = new Database($dsn, $username, $password);
    }

    public function getArticle()
    {
        if ($this->article === null) {
            $this->article = new Article($this->db);
        }
        return $this->article;
    }

    public function getCategory()
    {
        if ($this->category === null) {
            $this->category = new Category($this->db);
        }
        return $this->category;
    }

    public function getMember()
    {
        if ($this->member === null) {
            $this->member = new Member($this->db);
        }
        return $this->member;
    }

    public function getToken()
    {
        if ($this->token === null) {                     // If $token property null
            $this->token = new Token($this->db);         // Create Token object
        }
        return $this->token;                             // Return Token object
    }

    public function getLike()
    {
        if ($this->like === null) {                      // If $like property null
            $this->like = new Like($this->db);           // Create Like object
        }
        return $this->like;                              // Return Like object
    }

    public function getComment()
    {
        if ($this->comment === null) {                   // If $comment property null
            $this->comment = new Comment($this->db);     // Create Comment object
        }
        return $this->comment;                           // Return Comment object
    }

    public function getSession()
    {
        if ($this->session === null) {
            $this->session = new Session($this->db);
        }
        return $this->session;
    }
}