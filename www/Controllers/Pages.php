<?php 
namespace App\Controllers;

use App\Core\View;
use App\datatable\pagesTable;
use App\Forms\PagesForm;
use App\Forms\CreatePagesForm;
use App\Forms\UpdatePagesForm;
use App\Forms\DeletePagesForm;
use App\Models\Pages as PagesModel;
use App\Models\User;
use App\Memento\Caretaker;
use App\Memento\Origin;


class Pages {

    public function read() {

        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: /login');
            exit();
        }
        // Récupérer toutes les pages
        $pages =  PagesModel::getInstance();
        $allPages = $pages->getAll();
     
        $table = new pagesTable($allPages);

        $view = new View("Pages/read", "back");
        $view->assign("table", $table->getConfig($allPages));

         
    }

    public function create(): void
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: /login');
            exit();
        }
        $form = new PagesForm();
        $view = new View("Pages/create", "back");
        $view->assign("form", $form->getConfig());
        $view->assign("formErrors", $form->errors);

        if($form->isSubmitted() && $form->isValid()){
            $pages = new PagesModel();
            $pages->setTitle(htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8'));
            $pages->setContent(htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8'));
            $pages->setCreated_by($_SESSION['user_id']); // Définir l'ID de l'utilisateur qui a créé la page
            $pages->setSlug(htmlspecialchars($_POST['slug'], ENT_QUOTES, 'UTF-8'));
            $pages->setStatus(0); 
            $pages->save();
        
            header('Location: /pages');
            exit;

        // Afficher la vue du formulaire de création
        $view->render();
    }
}

  


    public function update($params): void
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: /login');
            exit();
        }
        $id = $params['id'];  // Récupère l'ID de l'utilisateur à partir des paramètres de l'URL
        
        $pagesModel = new PagesModel();
        $pages = $pagesModel->getOneWhere(["id"=> $id ]);  
        if (!$pages) {
            throw new \Exception('Page not found');
        }
        
        $form = new UpdatePagesForm();
        
        $view = new View("Pages/update", "back");
        $view->assign("form", $form->getConfig($pages));
        $view->assign("formErrors", $form->errors);
        
            if($form->isSubmitted() && $form->isValid()){
                $pages->setTitle($_POST['title']);
                $pages->setContent($_POST['content']);
                $pages->setSlug($_POST['slug']);
                $pages->setStatus($_POST['status']);
                $pages->save();
                header('Location: /pages');
            }
    }


        public function delete($params): void
        {
            if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
                header('Location: /login');
                exit();
            }
            $id = $params['id'];
        
            $pages =  PagesModel::getInstance();
            $pages = $pages->getOneWhere(["id"=> $id ]);  
            if (!$pages) {
                throw new \Exception('Page not found');
            }
        
            $pages->delete();
        
            header('Location: /pages');
        }

        //Ajout de propriétés Caretaker et Origin
        private Caretaker $caretaker;
        public function __construct()
        {
            $this->caretaker = new Caretaker();
        }
        

        public function publish($params): void
        {
            if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
                header('Location: /login');
                exit();
            }
            $id = $params['id'];  // Récupère l'ID de la page à partir des paramètres de l'URL
        
            $pagesModel = new PagesModel();
            $pages = $pagesModel->getOneWhere(["id"=> $id ]);  
            if (!$pages) {
                throw new \Exception('Page not found');
            }
        
            $origin = new Origin($pages);
            $this->caretaker->addMemento($origin); // Enregistre un memento avant la publication
        
            $pages->setStatus(1);  // Change le statut de la page à 1 (publié)
            $pages->save();
        
            header('Location: /pages');  // Redirige l'utilisateur vers la liste des pages
        }
        



    //unpublished page

    public function unpublish($params): void
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: /login');
            exit();
        }
        $id = $params['id'];  // Récupère l'ID de la page à partir des paramètres de l'URL
    
        $pagesModel = new PagesModel();
        $pages = $pagesModel->getOneWhere(["id"=> $id ]);  
        if (!$pages) {
            throw new \Exception('Page not found');
        }
    
        // Vérifie si la liste des mementos n'est pas vide avant de tenter d'obtenir le memento
        $origin = $this->caretaker->getMemento(0);
        if ($origin) {
            $origin->restoreMemento($origin);
        }
    
        $pages->setStatus(0);  // Change le statut de la page à 0 (non publié)
        $pages->save();
    
        header('Location: /pages');  // Redirige l'utilisateur vers la liste des pages
    }


public function show(): void
{
    if (!isset($_GET[0])) {
        throw new \Exception("No slug provided");
    }

    $slug = $_GET[0];

    $pagesModel = new PagesModel();
    $page = $pagesModel->getOneWhere(["slug" => $slug, "status" => 1]);  

    if (!$page) {
        http_response_code(404);
        exit;
    }

    $view = new View("Pages/show", "front");
    $view->assign("page", $page);
    $view->render();
}







//show page

public function toutesLesPages()
{
    $pagesModel = new PagesModel();
    $allPages = $pagesModel->getAll(); // Récupérez toutes les pages

    $view = new View("Pages/toutes-les-pages", "front");
    $view->assign("pages", $allPages); // Utilisez le nom de variable "pages" ici, pas "page"
    $view->render();
}






}