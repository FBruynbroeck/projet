<?php
namespace Projet\Controller;

class Login extends \Projet\App\Controller {

    public function index(){
        if(isset($_SESSION['login']))
        {
            header('Location: /');
            exit();
        }
        elseif(isset($_POST['login']) && isset($_POST['password'])){
            $login = $_POST['login'];
            $password = $_POST['password'];
            $this->loadModel('User');
            $this->User->id = $login;
            $user = $this->User->getOne();
            if($user && $user->verifyPassword($password)){
                $_SESSION['login'] = $login;
                $_SESSION['message'] = 'Bienvenue '.$login;
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
