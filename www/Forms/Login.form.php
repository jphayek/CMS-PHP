<?php

namespace App\Forms;

use App\Core\Validator;

class Login extends Validator
{
    public $method = "POST";
    protected array $config = [];

    public function getConfig(): array
    {
        $this->config = [
            "config" => [
                "method" => $this->method,
                "action" => "", // L'action du formulaire, à définir selon vos besoins
                "id" => "login-form",
                "class" => "form",
                "enctype" => "",
                "submit" => "Se connecter",
                "reset"=>"Annuler"
            ],
            "inputs" => [
                "email" => [
                    "id" => "login-form-email",
                    "class" => "form-input",
                    "placeholder" => "Votre email",
                    "type" => "email",
                    "error" => "Votre email est incorrect",
                    "required" => true
                ],
                "password" => [
                    "id" => "login-form-password",
                    "class" => "form-input",
                    "placeholder" => "Votre mot de passe",
                    "type" => "password",
                    "error" => "Votre mot de passe est incorrect",
                    "required" => true
                ]
            ]
        ];

        return $this->config;
    }
}
