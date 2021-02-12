<?php
namespace Projet\Controller;

class Order extends \Projet\App\ControllerClient {

    public function index(){
        $this->loadModel('Item');
        $this->loadModel('Book');
        $items = array();
        foreach($_SESSION['cart'] as $id => $value) {
            $item = $this->Item::getByPk($id);
            foreach (range(1, $value['quantity']) as $number) {
                array_push($items, $item);
            }
        }
        $this->Book->user_id = $this->current_user->id;
        $this->Book->status_id = ATTENTE;
        $this->Book->items = $items;
        $this->Book->save();
        unset($_SESSION['cart']);
        $_SESSION['message'] = 'La commande est envoyée';
        header('Location: /');
    }

}
