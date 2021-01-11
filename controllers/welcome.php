<?php
namespace Projet\Controller;

class Welcome extends \Projet\App\Controller {

    public function index(){
        $title = "Bienvenue";
        $this->render(compact('title'));
    }

}
