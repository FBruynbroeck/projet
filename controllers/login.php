<?php
namespace Projet\Controller;

class Login extends \Projet\App\Controller {

    public function index(){
        if(isset($_SESSION['login_id']))
        {
            header('Location: /');
            exit();
        }
        elseif(isset($_POST['login']) && isset($_POST['password'])){
            $this->loadModel('User');
            $user = $this->User::getByLogin($_POST['login']);
            if($user && $user->verifyPassword($_POST['password'])){
                $_SESSION['login_id'] = $user->id;
                $_SESSION['role_id'] = $user->role_id;
                $_SESSION['message'] = 'Bienvenue '.$user->login;
                header('Location: /');
                exit();
            }
            else {
                $_SESSION['error'] = "Mauvais login ou password";
            }
        }
        $title = 'Login';
        $this->render(compact('title'));
    }

}
