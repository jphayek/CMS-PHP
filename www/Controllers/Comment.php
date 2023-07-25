<?php

namespace App\Controllers;

use App\Core\View;
use App\datatable\commentTable;
use App\datatable\commentTableFront;
use App\Forms\CommentForm;
use App\Models\Comment as CommentModel;
use App\Models\Article;
use App\Models\User;

class Comment
{
    public function create(): void
    {
        // Vérifiez d'abord si l'utilisateur est connecté
        if(!isset($_SESSION['user_id'])) {
            // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            header('Location: /login');
            exit;
        }

        // Récupérez les informations de l'utilisateur et de l'article
        $userModel = new User();
        $articleModel = new Article();
        
        $user = $userModel->getOneWhere(["id" => $_SESSION['user_id']]);
        $article = $articleModel->getOneWhere(["id" => $_GET['article_id']]);
        
        
        // Vérifiez si l'article existe
        if(!$article) {
            echo "L'article n'existe pas!";
            return;
        }

        // Créez une nouvelle instance de formulaire de commentaire
        $form = new CommentForm();

        // Créez une nouvelle instance de vue
        $view = new View("Comment/create", "front");
        
        // Assurez-vous que le commentaire est envoyé via POST
        if($_SERVER['REQUEST_METHOD'] == 'POST' && $form->isSubmitted() && $form->isValid()) {
            // Récupérez le contenu du commentaire de la requête POST
            $commentContent = $_POST['content'];

            // Créez une nouvelle instance de commentaire
            $comment = new CommentModel();

            // Mettez à jour le modèle de commentaire avec les données reçues
            $comment->setUserId($user->getId());
            $comment->setArticleId($article->getId());
            $comment->setContent($commentContent);

            // Enregistrez le commentaire dans la base de données
            $comment->save();

            // Redirigez l'utilisateur vers la page de l'article
            header('Location: /article/show/?id=' . $article->getId());
            exit;
        }

        // Assigne les données au vue
        $view->assign("article", $article);
        $view->assign("form", $form->getConfig());
        $view->assign("formErrors", $form->errors);
    }

    public function read()
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: /login');
            exit();
        }
        // Récupérer tous les articles depuis la base de données
        $article = CommentModel::getInstance();
        $allArticles = $article->getAll();
        // Afficher les articles dans une vue appropriée
        $table = new commentTable($allArticles);

        $view = new View('Comment/read', 'back');
        $view->assign('table', $table->getConfig($allArticles));
        //$view->render();
    }
    
    public function approve()
{
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header('Location: /login');
        exit();
    }
    
    // Vérifiez si l'utilisateur est connecté et s'il est un administrateur
    // Ajoutez ici le code de vérification de l'administrateur, cela dépend de la façon dont vous gérez les utilisateurs et les rôles

    // Vérifiez si l'ID du commentaire est fourni
    if (!isset($_GET['id'])) {
        echo "ID du commentaire non fourni!";
        return;
    }

    // Récupérez l'ID du commentaire
    $commentId = $_GET['id'];

    // Récupérez le commentaire de la base de données
    $commentModel = new CommentModel();
    $comment = $commentModel->getOneWhere(["id" => $commentId]);

    // Vérifiez si le commentaire existe
    if (!$comment) {
        echo "Le commentaire n'existe pas!";
        return;
    }

    // Approuvez le commentaire
    $comment->setModerated(true);

    // Enregistrez le commentaire
    $comment->save();

    // Redirigez l'utilisateur vers la page précédente ou vers la page d'administration des commentaires
    header('Location: /comments');
    exit;
}

public function delete()
{
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header('Location: /login');
        exit();
    }
    // Vérifiez si l'utilisateur est connecté et s'il est un administrateur
    // Ajoutez ici le code de vérification de l'administrateur, cela dépend de la façon dont vous gérez les utilisateurs et les rôles

    // Vérifiez si l'ID du commentaire est fourni
    if (!isset($_GET['id'])) {
        echo "ID du commentaire non fourni!";
        return;
    }

    // Récupérez l'ID du commentaire
    $commentId = $_GET['id'];

    // Récupérez le commentaire de la base de données
    $commentModel = new CommentModel();
    $comment = $commentModel->getOneWhere(["id" => $commentId]);

    // Vérifiez si le commentaire existe
    if (!$comment) {
        echo "Le commentaire n'existe pas!";
        return;
    }

    // Supprimez le commentaire
    $comment->delete();

    // Redirigez l'utilisateur vers la page précédente ou vers la page d'administration des commentaires
    header('Location: /comments');
    exit;
}

public function show()
{
    // Récupérer l'ID de l'article depuis l'URL
    if (!isset($_GET['article_id']) || !is_numeric($_GET['article_id'])) {
        echo "ID de l'article non fourni ou invalide!";
        return;
    }

    $articleId = $_GET['article_id'];

    // Récupérer tous les commentaires modérés pour l'article spécifié
    $commentModel = new CommentModel();
    $moderatedComments = $commentModel->getAllWhere(["article_id" => $articleId, "moderated" => 1]);

    
    // Préparer la table de commentaires
    $commentTableFront = new commentTableFront($moderatedComments);

    // Préparer la vue
    $view = new View('Comment/show', 'front');

    // Assigner les données à la vue
    $view->assign("table", $commentTableFront->getConfig());

    // Afficher la vue
    $view->render();
}


}
