<?php

namespace App\Forms;

use App\Core\Validator;
use App\Models\Pages; 

class UpdatePagesForm extends Validator
{
    public $method = "POST";
    protected array $config = [];

    public function getConfig(Pages $pages = null) : array
    {
        $this->config = [
            "config" => [
                "method" => $this->method,
                "action" => "", // L'action du formulaire, à définir selon vos besoins  
                "id" => "update-pages-form",
                "class" => "form",
                "enctype" => "",
                "submit" => "Mettre à jour de la page",
            ],
            "inputs" => [
                'id' => [
                    'type' => 'hidden',
                    'class' => '', // Ajoutez cette ligne
                    'placeholder' => '', // Ajoutez cette ligne
                ],

                "title" => [
                    "id" => "update-pages-form-title",
                    "class" => "form-input",
                    "placeholder" => "Titre de la page",
                    "type" => "text",
                    "error" => "Votre titre est incorrect",
                    "value" => $pages ? $pages->getTitle() : '',
                    "required" => true
                ],

                "content" => [
                    "id" => "update-pages-form-content",
                    "class" => "form-input",
                    "placeholder" => "Contenu de la page",
                    "type" => "text",
                    "error" => "Votre contenu est incorrect",
                    "value" => $pages ? $pages->getContent() : '',
                    "required" => true
                ],

                "slug" => [
                    "id" => "update-pages-form-slug",
                    "class" => "form-input",
                    "placeholder" => "Slug de la page",
                    "type" => "text",
                    "error" => "Votre slug est incorrect",
                    "value" => $pages ? $pages->getSlug() : '',
                    "required" => true
                ],

                "status" => [
                    "id" => "update-pages-form-status",
                    "class" => "form-input",
                    "placeholder" => "Status de la page",
                    "type" => "text",
                    "error" => "Votre status est incorrect",
                    "value" => $pages ? $pages->getStatus() : '',
                    "required" => true
                ],


            ]
        ];

        return $this->config;
    }
}