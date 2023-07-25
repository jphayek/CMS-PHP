<?php

class BaseSQL{

    private static ?BaseSQL $instance = null;

    private function __construct()
    {
        echo "se connecter";
    }

    public static function getInstance(): BaseSQL
    {
        if(is_null(self::$instance)){
            self::$instance = new BaseSQL();
        }

        return  self::$instance;
    }

    public function save(): void
    {
        echo "sauvegarder";
    }

    public function get(): void
    {
        echo "récupérer";
    }

}

$sql = BaseSQL::getInstance();
$sql->save();

$sql = BaseSQL::getInstance();
$sql->get();