<?php
namespace Projet\Model;
require_once 'book_item.php';
require_once 'status.php';
require_once 'user.php';


class Book extends \Projet\App\Model {
    public $user;
    public $items;
    public $status;
    public $status_id;
    public $user_id;
    public $id;
    protected $columns = ['id', 'user_id', 'status_id'];

    public function __construct() {
        parent::__construct();
        if($this->id){
            $this->items = $this->getItems();
        }
        if($this->status_id){
            $this->status = $this->getStatus();
        }
        if($this->user_id){
            $this->user = $this->getUser();
        }
    }

    public function getItems(){
        $items = array();
        foreach(Book_item::get($this) as $value) {
            array_push($items, $value->getItem());
        }
        return $items;
    }

    public function getStatus(){
        return Status::getByPk($this->status_id);
    }

    public function getUser(){
        return User::getByPk($this->user_id);
    }

    public function save() {
        parent::save();
        foreach($this->items as $item){
            $book_item = new Book_item();
            $book_item->book_id = $this->id;
            $book_item->item_id = $item->id;
            $book_item->price = $item->price;
            $book_item->save();
        }
    }

    public static function get($user) {
        $instance = new static();
        $query = $instance->_pdo->prepare("select * from ".$instance->table." where user_id = :id");
        $query->execute([':id' => $user->id]);
        $query->setFetchMode(\PDO::FETCH_CLASS, get_class($instance));
        return $query->fetchAll();
    }

    public function total() {
        $total = 0;
        foreach ($this->getItems() as $item) {
            $total += $item->price;
        }
        return $total;
    }
}
