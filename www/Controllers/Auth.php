<?php

namespace App\Controllers;

use App\Core\View;
use App\Forms\Register;
use App\Forms\Login;
use App\Models\User;
use App\Models\Pages;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;





class Auth
{
    public function login(): void
    {
        //echo "Page de connexion";
        $form = new Login();
        $view = new View("Auth/login", "front");
        $view->assign("form", $form->getConfig());
        $view->assign("formErrors", $form->errors);
    
        // Formulaire soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            $email = $_POST['email'];
            $password = $_POST['password'];
    
        
            $user = new User();

            // Chercher l'utilisateur par email
            $user = $user->getOneWhere(["email" => $email]);
    
            // Vérifier si l'utilisateur existe et le mot de passe est correct
            if ($user && password_verify($password, $user->getPwd())){
                // Authentification réussie
                // Redirigez l'utilisateur vers la page d'accueil ou une autre page appropriée
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['firstname'] = $user->getFirstname();
                $_SESSION['role'] = $user->getRole();

                

                
                header('location: /');
                exit;
            } else {
                // Authentification échouée
                // Ajoutez un message d'erreur à afficher dans le formulaire de connexion
               echo "Erreur d'authentification";
            }
            

        }
    
        // Afficher le formulaire de connexion
        $view->render();
        //redirection vers la page dashboard
        /*header('Location: /dashboard.php');
        exit;*/
        
    }

    
   
    public function register(): void
    {
        $form = new Register();
        $view = new View("Auth/register", "front");
        $view->assign("form", $form->getConfig());

        //Form validé ? et correct ?
        if($form->isSubmitted() && $form->isValid()){
            $user = new User();
            $user->setFirstname($_POST['firstname']);
            $user->setLastname($_POST['lastname']);
            $user->setEmail($_POST['email']);
            $user->setPwd($_POST['pwd']);
            $user->setStatus(0); // Or another default value
            $user->setRole("user"); // Or another default value
           
            

                
         // Générer un token de vérification
        $verificationToken = bin2hex(random_bytes(50));
        $user->setVerificationToken($verificationToken);

        $user->save();

        // Envoyer un email de vérification
        $this->mail($user->getEmail(), $verificationToken);
            
          
      //  $user->save();
         
        
        }
        $view->assign("formErrors", $form->errors);
        //redirection vers la page de login
        /*header('Location: /login');
        exit;*/


    }

    public function logout(): void
    {
        // Démarrer la session si elle n'a pas déjà été démarrée
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    // Détruire la session existante
    session_destroy();

        echo "Page de déconnexion";
        header('Location: /login');
        exit;
    }
    
    function mail($email, $verificationToken) {
        $messageInfoSendMail = [];
    
        try {
            $mail = new PHPMailer(true);
            $mail->IsSMTP();
            $mail->Mailer = "smtp";
            $mail->SMTPDebug = 0;
            $mail->Port = 1025;
            $mail->Host = "mailcatcher";
            $mail->IsHTML(true);
            $mail->AddAddress($email, "recipient-name");
            $mail->SetFrom("jphayek@myges.fr", "from-name");
            $mail->Subject = "Test Subject";
            
            // Construire le lien de vérification.
            // Supposons que votre méthode de vérification soit accessible à l'URL /verify et prenne un paramètre token.
            //$verifyLink = "http://localhost/verify?token=$verificationToken";
            $verifyLink = "http://localhost/verify?token=$verificationToken";
            $content = "<p>Cliquez sur le lien suivant pour valider votre compte: <a href=\"$verifyLink\">$verifyLink</a></p>";
            
            $mail->MsgHTML($content);
    
            if (!$mail->Send()) {
                $messageInfoSendMail[] = "Error while sending Email.";
            } else {
                $messageInfoSendMail[] = "Email sent successfully";
            }
        } catch (Exception $e) {
            $messageInfoSendMail = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        } 
    
        return $messageInfoSendMail;
    }

    public function verify() {
        if (!isset($_GET['token'])) {
            // Il n'y a pas de token dans la demande, renvoyez une erreur ou redirigez l'utilisateur.
            header('Location: /error');
            exit;
        }
        
        $token = $_GET['token'];
        
       
       $userModel = new User();
       $user = $userModel->getOneWhere(["verificationToken" => $token]);
;
        
        if ($user === null) {
            // Il n'y a pas d'utilisateur avec ce token, renvoyez une erreur ou redirigez l'utilisateur.
            header('Location: /error');
            exit;
        }
        
        // Mettre à jour le statut de l'utilisateur et enregistrer l'utilisateur.
        $user->setStatus(1);
        $user->save();
        
        // L'utilisateur a été vérifié, redirigez-le où vous voulez.
        header('Location: /login');
        exit;
    }




    
    
 





}