<?php

namespace App\datatable;




class pagesTable 
{
  
    protected array $config = [];
    private  $pages;

    public function __construct($pages)
    {
        $this->pages = $pages;
    }
    
    public function getConfig($pages): array
    {

        $this->config = [

            "config" => [
                "id" => "pages-table",
                "class" => "table",
            ],
            "headers" => [
                "Title" => "Title",
                "Content" => "Content",
                "created_by" => "Created by",
                "slug" => "Slug",
                "status" => "Status",  // Ajoutez le header de statut
            ],
            "body" =>[
                "title" => "title",
                "content" => "content",
                "created_by" => "created_by",
                "slug" => "slug",
                "status" => "status",  // Ajoutez le champ de statut
            ],
            "data" => $this->pages,
            "actions" => [
                "update" => "/pages/update?id=",
                "delete" => "/pages/delete?id=",
                
                "publish" => "/pages/publish?id=", // Ajoutez l'action de publication
                "unpublish" => "/pages/unpublish?id=", // Ajoutez l'action de dépublication
                
            ],              
        ];

        
    

        return $this->config;
    }
}

