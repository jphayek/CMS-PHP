<?php

namespace App;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';   
require 'PHPMailer/src/Exception.php';   

session_start();

spl_autoload_register(function ($class) {
    $class = str_replace("App\\","", $class);
    $class = str_replace("\\","/", $class);
    $classForm = $class.".form.php";
    $class = $class.".php";

    if(file_exists($class)){
        include $class;
    } else if(file_exists($classForm)){
        include $classForm;
    }
});

// Retrieve the current URL.
$uri = $_SERVER["REQUEST_URI"];
$uriExploded = explode("?", $uri);
$uri = strtolower(trim($uriExploded[0], "/"));

if(empty($uri)){
    $uri = "default";
}

if(!file_exists("routes.yml")){
    die("Le fichier routes.yml n'existe pas");
}

$routes = yaml_parse_file("routes.yml");

$found = false;

foreach($routes as $pattern => $route) {
    $pattern = str_replace("{slug}", "([^/]+)", $pattern);
    $pattern = "@^".$pattern."$@i";

    if(preg_match($pattern, $uri, $matches)) {
        array_shift($matches);
        $_GET = array_merge($_GET, $matches);
        $found = $route;
        break;
    }
}

if($found) {
    if(empty($found["controller"]) || empty($found["action"])){
        die("Cette route ne possède pas de controller ou d'action dans le fichier de routing");
    }

    $controller = $found["controller"];
    $action = $found["action"];
    
    // Include the controller file.
    if(!file_exists("Controllers/".$controller.".php")){
        die("Le fichier Controllers/".$controller.".php n'existe pas");
    }
    include "Controllers/".$controller.".php";

    $controller = "\\App\\Controllers\\".$controller;

    // Check if the class exists.
    if(!class_exists($controller)){
        die("La classe ".$controller." n'existe pas");
    }

    $objController = new $controller();

    // Check if the action exists.
    if(!method_exists($objController, $action)){
        die("L'action ".$action." n'existe pas");
    }

    // Call the action.
    $objController->$action($_GET);
} else {
    // If no static route has been found, display a 404 error.
    die("Page 404");
}
