<?php
namespace Projet\Controller;

class Cart extends \Projet\App\Controller {

    public function index(){
        if (!isset($_SESSION['cart'])){
            $_SESSION['cart'] = array();
        }
        $total = 0;
        foreach($_SESSION['cart'] as $id => $value){
            $total += $value['quantity'];
        }
        echo $total;
    }

    public function add($id){
        if (!isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] = 1;
        }
        else {
            $_SESSION['cart'][$id]['quantity'] += 1;
        }
    }

    public function edit($id){
        if ($_POST['quantity'] == 0) {
            unset($_SESSION['cart'][$id]);
        }
        else {
            $_SESSION['cart'][$id]['quantity'] = $_POST['quantity'];
        }
    }
}
