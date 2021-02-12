<?php
namespace Projet\Controller;

class Articles extends \Projet\App\Controller {

    public function index(){
        $title = "Articles";
        $this->loadModel('Item');
        $items = $this->Item->getAvailable();
        $this->render(compact('title', 'items'));
    }
}
