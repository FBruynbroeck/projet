<?php
namespace Projet\Controller;

class Welcome extends \Projet\App\Controller {

    public function index(){
        $title = TITLE;
        $this->render(compact('title'));
    }

}
