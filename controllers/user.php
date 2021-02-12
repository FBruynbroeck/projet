<?php
namespace Projet\Controller;

class User extends \Projet\App\ControllerClient {

    public function index(){
        $title = "Utilisateur";
        $this->loadModel('User');
        $user = $this->current_user;
        # Faire ['title' => $title, 'user' => $user]
        # est égal à compact('title', 'user')
        #$this->render(['title' => $title, 'user' => $user]);
        $this->render(compact('title', 'user'));
    }

    public function edit(){
        $title = "Modifier l'utilisateur";
        $this->loadModel('User');
        $user = $this->current_user;
        if (!empty($_POST) && !empty($_POST['login']) && !empty($_POST['email'])){
            if($_POST['password'] != $_POST['confirm_password'])
            {
                $_SESSION['error'] = "Votre mot de passe et votre mot de passe de confirmation ne correspondent pas...";
            }
            else
            {
                $user->email = $_POST['email'];
                $user->login = $_POST['login'];
                if($_POST['password']){
                    $user->setPassword($_POST['password']);
                }
                $user->update();
                $_SESSION['message'] = 'L\'utilisateur '.$user->login.' a bien été mis à jour';
                header('Location: /user/'.$user->login.'/edit');
                exit();
            }
        }
        $view = 'user_edit';
        $this->render(compact('title', 'user', 'view'));
    }
}
