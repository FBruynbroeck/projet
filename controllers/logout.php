<?php
namespace Projet\Controller;

class Logout extends \Projet\App\Controller {
    public function index(){
        session_unset(); //$_SESSION = [];
        //session_destroy();
        $_SESSION['message'] = 'Vous êtes déconnecté';
        header("Location: /");
    }
}
