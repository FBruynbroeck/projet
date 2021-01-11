<?php
namespace Projet\Controller;

class User extends \Projet\App\ControllerAdmin {

    public function index($id){
        $title = "Utilisateur";
        $this->loadModel('User');
        if (!$id) {
            $id = $_SESSION['login'];
        }
        $this->User->id = $id;
        $user = $this->User->getOne();
        # Faire ['title' => $title, 'user' => $user]
        # est égal à compact('title', 'user')
        #$this->render(['title' => $title, 'user' => $user]);
        $this->render(compact('title', 'user'));
    }
}
