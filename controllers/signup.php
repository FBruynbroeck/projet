<?php
namespace Projet\Controller;

class Signup extends \Projet\App\Controller {

    public function index(){
        if(isset($_SESSION['login_id']))
        {
            header('Location: /');
            exit();
        }
        elseif(isset($_POST['login']) && isset($_POST['password'])){
            $this->loadModel('User');
            if($this->User::getByLogin($_POST['login'])){
                $_SESSION['error'] = "L'utilisateur existe déjà";
            }
            else {
                $this->User->login = $_POST['login'];
                $this->User->setPassword($_POST['password']);
                $this->User->role_id = CLIENT;
                $this->User->email = $_POST['email'];
                $this->User->valid = 1;
                $this->User->save();
                $_SESSION['login_id'] = $this->User->id;
                $_SESSION['role_id'] = $this->User->role_id;
                $_SESSION['message'] = 'Bienvenue '.$this->User->login;
                header('Location: /');
                exit();
            }
        }
        $title = 'Nouvel utilisateur';
        $this->render(compact('title'));
    }

}
