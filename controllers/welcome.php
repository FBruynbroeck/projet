<?php
namespace Projet\Controller;

class Welcome extends \Projet\App\Controller {

    public function index(){
        $title = "E-commerce";
        $this->render(compact('title'));
    }

}
