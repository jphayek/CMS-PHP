<?php

namespace App\Forms;

use App\Core\Validator;

class UserForm extends Validator
{
    public $method = "POST";
    protected array $config = [];

    public function getConfig(): array
    {
        $this->config = [
            "config" => [
                "method" => $this->method,
                "action" => "", // L'action du formulaire, à définir selon vos besoins
                "id" => "user-form",
                "class" => "form",
                "enctype" => "",
                "submit" => "Create user",
                "reset" => "Réinitialiser"
            ],
            "inputs" => [
                "firstname" => [
                    "id" => "user-form-firstname",
                    "class" => "form-input",
                    "placeholder" => "Prénom",
                    "type" => "text",
                    "error" => "Votre prénom est incorrect",
                    "required" => true
                ],
                "lastname" => [
                    "id" => "user-form-lastname",
                    "class" => "form-input",
                    "placeholder" => "Nom de famille",
                    "type" => "text",
                    "error" => "Votre nom de famille est incorrect",
                    "required" => true
                ],
                "email" => [
                    "id" => "user-form-email",
                    "class" => "form-input",
                    "placeholder" => "Email",
                    "type" => "email",
                    "error" => "Votre email est incorrect",
                    "required" => true
                ],
                "password" => [
                    "id" => "user-form-password",
                    "class" => "form-input",
                    "placeholder" => "Mot de passe",
                    "type" => "password",
                    "error" => "Votre mot de passe est incorrect",
                    "required" => true
                ],
                "role" => [
                    "id" => "user-form-role",
                    "class" => "form-input",
                    "placeholder" => "Rôle",
                    "type" => "text",
                    "error" => "Le rôle est incorrect",
                    "required" => true
                ]
            ]
        ];

        return $this->config;
    }

}
