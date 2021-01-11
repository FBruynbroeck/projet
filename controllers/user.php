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

    public function edit($id){
        $title = "Modifier l'utilisateur";
        $this->loadModel('User');
        $this->User->id = $id;
        $user = $this->User->getOne();

        if (!empty($_POST) && !empty($_POST['login']) && !empty($_POST['email'])){
            if($_POST['password'] != $_POST['confirm_password'])
            {
                $_SESSION['error'] = "Votre mot de passe et votre mot de passe de confirmation ne correspondent pas...";
            }
            else
            {
                $this->User->update(['email' => $_POST['email']]);
                $_SESSION['message'] = 'L\'utilisateur '.$user->login.' a bien été mis à jour';
                $user = $this->User->getOne();
            }
        }
        $view = 'user_edit';
        $this->render(compact('title', 'user', 'view'));
    }
}
