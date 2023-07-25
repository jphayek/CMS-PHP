<?php

namespace App\Forms;

use App\Core\Validator;
use App\Models\Article; 

class UpdateArticleForm extends Validator
{
    public $method = "POST";
    protected array $config = [];

    public function getConfig(Article $article = null) : array
    {
        $this->config = [
            "config" => [
                "method" => $this->method,
                "action" => "", // L'action du formulaire, à définir selon vos besoins  
                "id" => "update-article-form",
                "class" => "form",
                "enctype" => "",
                "submit" => "Mettre à jour l'article",
            ],
            "inputs" => [
                'id' => [
                    'type' => 'hidden',
                    'class' => '', // Ajoutez cette ligne
                    'placeholder' => '', // Ajoutez cette ligne
                ],

                "title" => [
                    "id" => "update-article-form-title",
                    "class" => "form-input",
                    "placeholder" => "Titre de l'article",
                    "type" => "text",
                    "error" => "Votre titre est incorrect",
                    "value" => $article ? $article->getTitle() : '',
                    "required" => true
                ],

                "content" => [
                    "id" => "update-article-form-content",
                    "class" => "form-input",
                    "placeholder" => "Contenu de l'article",
                    "type" => "text",
                    "error" => "Votre contenu est incorrect",
                    "value" => $article ? $article->getContent() : '',
                    "required" => true
                ]


            ]
        ];

        return $this->config;
    }
}