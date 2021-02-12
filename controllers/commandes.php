<?php
namespace Projet\Controller;

class Commandes extends \Projet\App\ControllerClient {

    public function index(){
        $title = "Mes commandes";
        $this->loadModel('Book');
        $books = \Projet\Model\Book::get($this->current_user);
        $this->render(compact('title', 'books'));
    }
}
