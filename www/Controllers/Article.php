<?php
namespace App\Controllers;
use App\Core\View;
use App\datatable\articleTable;

use App\Forms\CreateArticleForm;
use App\Forms\UpdateArticleForm;
use App\Forms\DeleteArticleForm;

use App\Models\Article as ArticleModel;
use App\Models\User;
use App\Forms\ArticleForm;

class Article{
    
    public function read()
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: /login');
            exit();
        }
        // Récupérer tous les articles depuis la base de données
        $article = ArticleModel::getInstance();
        $allArticles = $article->getAll();
        // Afficher les articles dans une vue appropriée
        $table = new articleTable($allArticles);

        $view = new View('Article/read', 'back');
        $view->assign('table', $table->getConfig($allArticles));
        //$view->render();
    }

    public function create(): void
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: /login');
            exit();
        }
        $form = new ArticleForm();
        $view = new View("Article/create", "back");
        $view->assign("form", $form->getConfig());
        $view->assign("formErrors", $form->errors);
    
        if($form->isSubmitted() && $form->isValid()){
            $article = new ArticleModel();
            $article->setTitle($_POST['title']);
            $article->setContent($_POST['content']);
          
            $article->setAuthor($_SESSION['user_id']);
            $article->save();


            header('Location: /articles');
        }
    }

    //update article
    public function update($params): void
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: /login');
            exit();
        }
        $id = $params['id'];  // Récupère l'ID de l'utilisateur à partir des paramètres de l'URL
    
        $articleModel = new ArticleModel();
        $article = $articleModel->getOneWhere(["id"=> $id ]);  // Obtient l'utilisateur par son ID
        if (!$article) {
            throw new \Exception('Article not found');
        }
    
        $form = new UpdateArticleForm();
    
        $view = new View("Article/update", "back");
        $view->assign("form", $form->getConfig($article)); 
        $view->assign("formErrors", $form->errors);
    
        if($form->isSubmitted() && $form->isValid()){
            $article->setTitle($_POST['title']);
            $article->setContent($_POST['content']);
            $article->save();
            header('Location: /articles');
        }
    }

    //delete article
    public function delete($params): void
{
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header('Location: /login');
        exit();
    }
    if (!isset($params['id'])) {
        throw new \Exception('Article ID not provided');
    }

    $id = $params['id'];
    $article = new ArticleModel();
    $article = $article->getOneWhere(["id" => $id]);

    if (!$article) {
        throw new \Exception('Article not found');
    }

    $article->delete();

    header('Location: /articles');
}


public function show($params)
{
    $id = $params['id'];
    if (!isset($params['id'])) {
        throw new \Exception('Article ID not provided');
    }

    

    $articleModel = ArticleModel::getInstance();
    $article = $articleModel->getOneWhere(["id" => $id]);

    if (!$article) {
        throw new \Exception('Article not found');
    }

    $view = new View("Article/show", "front");
    $view->assign("article", $article);
    $view->render();
}

//Filtrer les articles par category

public function readByCategory($params)
{
    // Récupérez l'ID de la catégorie à partir des paramètres de l'URL
    $categoryId = $params['id'];
 
    // Récupérez tous les articles de la catégorie depuis la base de données
    $articleModel = ArticleModel::getInstance();
    
    //$articlesByCategory = $articleModel->getOneWhere(["id" => $categoryId]);
    $articlesByCategory = $articleModel->getArticlesByCategory($categoryId);
    
    // Affichez les articles dans une vue appropriée
    $table = new articleTable($articlesByCategory);

    //$view = new View('Article/read', 'back');
    $view = new View('Article/read', 'front');
    $view->assign('table', $table->getConfig($articlesByCategory));
}

public function filterArticlesByCategory()
    {
        // Récupérez la catégorie sélectionnée depuis la requête AJAX (utilisez $_POST ou $_GET en fonction de la méthode d'envoi)
        $categoryId = $_GET['category_id']; // Assurez-vous que cette valeur est valide et sécurisée
        
        // Exécutez la requête SQL pour récupérer les articles filtrés par la catégorie
        $filteredArticles = $this->articleModel->getArticlesByCategory($categoryId); // Utilisez votre modèle d'article

        // Vous pouvez renvoyer les articles au format JSON
        header('Content-Type: application/json');
        echo json_encode($filteredArticles);

        // Ou vous pouvez renvoyer les articles au format HTML
        // Générez le contenu HTML des articles filtrés
        // ...
        // echo $htmlContent;
    }

}
    

    
