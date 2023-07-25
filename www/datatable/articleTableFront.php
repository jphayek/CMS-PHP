<?php

namespace App\datatable;




class articleTableFront 
{
  
    protected array $config = [];
    private  $articles;

    public function __construct($articles)
    {
        $this->articles = $articles;
    }
    
    
    public function getConfig($articles): array
    {

        $this->config = [

            "config" => [
                "id" => "article-table",
                "class" => "table",
            ],
            "headers" => [
                
                "title" => "Title",
                "content" => "Content",
                //"user_id" => "User_id",
               
                "Created_at" => "Date Creation",
            ],
            "body" =>[
                "title" => "Title",
                "content" => "Content",
                //"user_id" => "User_id",
               
                "Created_at" => "Created_at",
            ],
            "data" => $this->articles,
            "actions" => [
                
                "comment" => "/comment/create?id=",
            ],
              
        ];
    

        return $this->config;
    }
}
