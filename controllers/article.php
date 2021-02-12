<?php
namespace Projet\Controller;

class Article extends \Projet\App\Controller {

    public function index($title){
        $this->loadModel('Item');
        $item = $this->Item::getByTitle($title);
        if($item){
            $title = $item->title;
            $this->render(compact('title', 'item'));
            exit();
        }
        else {
            header('Location: /');
            exit();
        }
    }
}
