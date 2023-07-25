<?php

namespace App\datatable;

class CommentTable 
{
    protected array $config = [];
    private $comments;

    public function __construct($comments)
    {
        $this->comments = $comments;
    }
    
    public function getConfig(): array
    {
        $this->config = [
            "config" => [
                "id" => "comment-table",
                "class" => "table",
            ],
            "headers" => [
                "content" => "Comment",
                "articleId" => "Article ID", 
                "user_id" => "Author ID",
                "created_at" => "Date",
                "flagged" => "Flagged",
                "moderated" => "Moderated",
            ],
            "body" => [ // Ajoutez cette ligne
                "content",
                "articleId", 
                "userId",
                "createdAt", // Modifier cette ligne
                "flagged",
                "moderated"
            ],
            "data" => $this->comments, // Passons directement les commentaires à la vue
            "actions" => [
                "approve" => "/comment/approve?id=",
                "delete" => "/comment/delete?id=",
            ],
        ];

        return $this->config;
    }
}
