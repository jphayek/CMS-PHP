<?php
namespace App\Forms;
use App\Core\Validator;


class CommentForm extends Validator
{
    public $method = "POST";
    protected array $config;

    public function __construct()
    {
        $this->config = [
            "config" => [
                "method" => $this->method,
                "action" => "", // L'action du formulaire, à définir selon vos besoins
                "id" => "comment-form",
                "class" => "form",
                "enctype" => "",
                "submit" => "Post Comment",
                "reset" => "Réinitialiser"
            ],
            "inputs" => [
                "content" => [
                    "id" => "comment-form-content",
                    "class" => "form-input",
                    "placeholder" => "Your comment here",
                    "type" => "text",
                    "error" => "Your comment is incorrect",
                    "required" => true
                ],
                "article_id" => [ // champ caché pour stocker l'id de l'article
                    "type" => "hidden"
                ],
                "user_id" => [ // champ caché pour stocker l'id de l'utilisateur
                    "type" => "hidden"
                ]
            ]
        ];
    }

    public function getConfig(): array
    {
        return $this->config;
    }
}
