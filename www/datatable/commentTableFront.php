<?php

namespace App\datatable;

class CommentTableFront 
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
                "user_id" => "Author ID",
                "created_at" => "Date",
            
            ],
            "body" => [ // Ajoutez cette ligne
                "content",
                "userId",
                "createdAt", // Modifier cette ligne
                
            ],
            "data" => $this->comments, // Passons directement les commentaires à la vue
            "actions" => [
                "signal" => "/comment/signal?id=",
            ],
        ];

        return $this->config;
    }
}
