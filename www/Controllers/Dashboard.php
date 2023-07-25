<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\User;
use App\Models\Article;
use App\Models\Pages;
use App\Models\Comment;

class Dashboard
{
    public function index(): void
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
            // L'utilisateur n'est pas connecté, le rediriger vers la page de connexion
            header('Location: /login');

            exit;
        }

        // Nombre total d'utilisateurs
        $userModel = new User();
        $userCount = $userModel->count();
        

        // Nombre total d'articles
        $articleModel = new Article();
        $articleCount = $articleModel->count();

        // Nombre total de pages
        $pagesModel = new Pages();
        $pagesCount = $pagesModel->count();

        //nombre total de commentaires
        $commentModel = new Comment();
        $commentCount = $commentModel->count();


        $view = new View('dashboard', 'back');
        $view->assign('userCount', $userCount);
        $view->assign('articleCount', $articleCount);
        $view->assign('pagesCount', $pagesCount);
        $view->assign('commentCount', $commentCount);
       
        // Afficher la vue
        $view->render();
    }
/*
    public function changeTheme() {
        if (isset($_POST['theme'])) {
            $_SESSION['theme'] = $_POST['theme'];
        }

        // rediriger l'utilisateur vers le tableau de bord
        header('Location: /dashboard');
    }

   */ 
    
}
