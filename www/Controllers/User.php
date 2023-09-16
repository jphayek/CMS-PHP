<?php 
namespace App\Controllers;

use App\Core\View;
use App\datatable\userTable;
use App\Forms\CreateUserForm;
use App\Forms\UpdateUserForm;
use App\Forms\DeleteUserForm;
use App\Forms\EditUserForm;
use App\Models\User as UserModel;
use App\Forms\UserForm;

class User {
    public function read() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: /login');
            exit();
        }
        // Récupérer tous les utilisateurs
        $user =  UserModel::getInstance();
        $allUsers = $user->getAll();
     
        $table = new userTable($allUsers);

        $view = new View("User/read", "back");
        $view->assign("table", $table->getConfig($allUsers));

         
    }

    public function create(): void
    { 
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: /login');
            exit();
        }
        $form = new UserForm();
        $view = new View("User/create", "back");
        $view->assign("form", $form->getConfig());
        $view->assign("formErrors", $form->errors);
    
        if($form->isSubmitted() && $form->isValid()){
            $user = new UserModel();
            $user->setFirstname($_POST['firstname']);
            $user->setLastname($_POST['lastname']);
            $user->setEmail($_POST['email']);
            $user->setPwd(password_hash($_POST['password'], PASSWORD_BCRYPT));
            $user->setRole($_POST['role']);
            $user->setStatus(1); // Mettre le statut à 1, puisque l'admin crée l'utilisateur
            $user->save();
            header('Location: /users');
        }
    }
    
    public function update($params): void
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: /login');
            exit();
        }
        $id = $params['id'];  // Récupère l'ID de l'utilisateur à partir des paramètres de l'URL
    
        $userModel = new UserModel();
        $user = $userModel->getOneWhere(["id"=> $id ]);  // Obtient l'utilisateur par son ID
        //var_dump($user);
        if (!$user) {
            throw new \Exception('User not found');
        }
    
        $form = new UpdateUserForm();
    
        $view = new View("User/update", "back"); // Déplacez cette ligne ici
        $view->assign("form", $form->getConfig($user)); // Modifiez cette ligne pour passer $user
        $view->assign("formErrors", $form->errors);
        if($form->isSubmitted() && $form->isValid()){
            $user->setFirstname($_POST['firstname']);
            $user->setLastname($_POST['lastname']);
            $user->setEmail($_POST['email']);
    
            // Seulement mettre à jour le mot de passe s'il est fourni
            if (!empty($_POST['password'])) {
                $user->setPwd(password_hash($_POST['password'], PASSWORD_BCRYPT));
            }
    
            $user->setRole($_POST['role']);
            $user->save();
            header('Location: /users');
        }
    }
    

    public function delete($params): void
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: /login');
            exit();
        }
        $id = $params['id'];  // Récupère l'ID de l'utilisateur à partir des paramètres de l'URL
    
        $user =  UserModel::getInstance();
        $user = $user->getOneWhere(["id"=> $id ]);  // Obtient l'utilisateur par son ID
    
        if (!$user) {
            throw new \Exception('User not found');
        }
    
        $user->delete();
    
        // Redirige vers une autre page, par exemple, la liste des utilisateurs
        header('Location: /users');
    }

    public function editProfile($params): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }
    
        $userId = $_SESSION['user_id'];
    
        $userModel = new UserModel();
        $user = $userModel->getOneWhere(["id" => $userId]);
    
        if (!$user) {
            throw new \Exception('User not found');
        }
    
        $form = new EditUserForm();
    
        $view = new View("User/editProfile", "front");
        $view->assign("form", $form->getConfig($user));
        $view->assign("formErrors", $form->errors);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setFirstname(htmlspecialchars($_POST['firstname'], ENT_QUOTES, 'UTF-8'));
            $user->setLastname(htmlspecialchars($_POST['lastname'], ENT_QUOTES, 'UTF-8'));
            $user->setEmail(htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8'));
    
            if (!empty($_POST['password'])) {
                $user->setPwd(password_hash($_POST['password'], PASSWORD_BCRYPT));
            }
    
            $user->save();
            header('Location: /');
            exit();
        }
    }
    

    

}
