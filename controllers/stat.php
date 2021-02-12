<?php
namespace Projet\Controller;

class Stat extends \Projet\App\ControllerAdmin {

    public function index(){
        $title = "Statistiques";
        $this->render(compact('title'));
    }

    public function json(){
        $this->loadModel('Book_item');
        $book_items = $this->Book_item::getAll();
        $items = array();
        foreach($book_items as $book_item){
            $item = $book_item->getItem();
            if(array_key_exists($item->title, $items)){
                $items[$item->title] += 1;
            } else {
                $items[$item->title] = 1;
            }
        }
        echo json_encode($items);
    }

}
