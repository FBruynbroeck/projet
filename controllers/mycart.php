<?php
namespace Projet\Controller;

class Mycart extends \Projet\App\Controller {

    public function index(){
        $title = "Mon panier";
        $this->loadModel('Item');
        $items = array();
        $total_prices = 0;
        $total_items = 0;
        foreach($_SESSION['cart'] as $id => $value){
                $item = $this->Item::getByPk($id);
                $item->quantity = $value['quantity'];
                $total_prices += $item->total();
                $total_items += $item->quantity;
                array_push($items, $item);
        }
        $this->render(compact('title', 'items', 'total_prices', 'total_items'));
    }
}
