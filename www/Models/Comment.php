<?php

namespace App\Models;

use App\Core\SQL;

class Comment extends SQL
{
    private Int $id = 0;
    protected int $article_id;
    protected int $user_id;
    protected string $content;
    protected string $created_at;
    protected int $moderated = 0;
    protected int  $flagged = 0; 
    protected int $flagged_count;
  

    public function __construct(){
        parent::__construct();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getArticleId(): int
    {
        return $this->article_id;
    }

    public function setArticleId(int $article_id): void
    {
        $this->article_id = $article_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getModerated(): int
    {
        return $this->moderated;
    }
    
    public function setModerated(int $moderated): void
    {
        $this->moderated = $moderated;
    }

    public function getFlagged(): int {
        return $this->flagged;
    }

    public function setFlagged(int $flagged): void {
        $this->flagged = $flagged;
    }

    public function getFlaggedCount(): int
    {
        return $this->flagged_count;
    }

    public function setFlaggedCount(int $flagged_count): void
    {
        $this->flagged_count = $flagged_count;
    }


   
}
