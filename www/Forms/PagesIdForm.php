<?php

namespace App\Forms;

use App\Core\Validator;
use App\Models\Pages; 

class PagesIdForm extends Validator
{
    public $method = "POST";
    protected array $config = [];

    public function getConfig(Pages $pages = null) : array
    {
        $this->config = [
            "config" => [
                "method" => $this->method,
                "action" => "", // L'action du formulaire, à définir selon vos besoins  
                "id" => "pageid-form",
                "class" => "form",
                "enctype" => "",
                "submit" => "TEST SUBMIT",
            ],
            "inputs" => [
                'id' => [
                    'type' => 'hidden',
                    'class' => '', // Ajoutez cette ligne
                    'placeholder' => '', // Ajoutez cette ligne
                ],

                "title" => [
                    "id" => "pageid-form-title",
                    "class" => "form-input",
                    "placeholder" => "Titre de la page",
                    "type" => "text",
                    "error" => "Votre titre est incorrect",
                    "value" => $pages ? $pages->getTitle() : '',
                    "required" => true
                ],

                "content" => [
                    "id" => "pageid-form-content",
                    "class" => "form-input",
                    "placeholder" => "Contenu de la page",
                    "type" => "text",
                    "error" => "Votre contenu est incorrect",
                    "value" => $pages ? $pages->getContent() : '',
                    "required" => true
                ]


            ]
        ];

        return $this->config;
    }
}