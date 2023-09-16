<?php

namespace App\Forms;

use App\Core\Validator;
use App\Models\User;

class EditUserForm extends Validator
{
    public $method = "POST";
    protected array $config = [];

    public function getConfig(User $user = null): array
    {
        $this->config = [
            "config" => [
                "method" => $this->method,
                "action" => "", // L'action du formulaire, à définir selon vos besoins
                "id" => "update-user-form",
                "class" => "form",
                "enctype" => "",
                "submit" => "Mettre à jour l'utilisateur",
            ],
            "inputs" => [
                "id" => [
                    "type" => "hidden",
                    "class" => "", // Ajoutez cette ligne
                    "placeholder" => "", // Ajoutez cette ligne
                ],
                
                "firstname" => [
                    
                    "id" => "update-user-form-firstname",
                    "class" => "form-input",
                    "placeholder" => "Prénom de l'utilisateur",
                    "type" => "text",
                    "error" => "Votre prénom est incorrect",
                    "value" => $user ? $user->getFirstname() : '',
                    "required" => true
                   
                ],
                "lastname" => [
                    "id" => "update-user-form-lastname",
                    "class" => "form-input",
                    "placeholder" => "Nom de l'utilisateur",
                    "type" => "text",
                    "error" => "Votre nom est incorrect",
                    "value" => $user ? $user->getLastname() : '',
                    "required" => true
                ],
                "email" => [
                    "id" => "update-user-form-email",
                    "class" => "form-input",
                    "placeholder" => "Email de l'utilisateur",
                    "type" => "email",
                    "error" => "Votre email est incorrect",
                    "value" => $user ? $user->getEmail() : '',
                    "required" => true
                ]
            ]
        ];

        return $this->config;
    }
    

}
