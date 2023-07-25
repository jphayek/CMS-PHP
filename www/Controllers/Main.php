<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Article;
//use App\datatable\articleTable;
use App\datatable\articleTableFront;

class Main
{
   /* public function home(): void
    {
        $pseudo = "Prof";
        $view = new View("Main/home", "front");
        $view->assign("pseudo", $pseudo);
        $view->assign("age", 30);
        $view->assign("titleseo", "supernouvellepage");
    }*/

    public function contact(): void
    {
        echo "Page de contact";
    }

    public function aboutUs(): void
    {
        echo "Page à propos";
    }

    public function home()
    {
        $articleModel = new Article();
    $articles = $articleModel->getAll();
    
    // Passer les articles à la vue
    $view = new View("Main/home", "front");
    $view->assign("articles", $articles);
        
    }
    

}