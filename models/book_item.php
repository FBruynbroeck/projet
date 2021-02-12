<?php
namespace Projet\Model;
require_once 'item.php';


class Book_item extends \Projet\App\Model {
    public $book;
    public $item;
    public $price;
    public $item_id;
    protected $columns = ['id', 'book_id', 'item_id', 'price'];

    public function __construct() {
        parent::__construct();
        if($this->item_id){
            $this->item = $this->getItem();
        }
    }

    public function getItem(){
        $item = Item::getByPk($this->item_id);
        $item->price = $this->price;
        return $item;
    }

    public static function get($book) {
        $instance = new static();
        $query = $instance->_pdo->prepare("select * from ".$instance->table." where book_id = :id");
        $query->execute([':id' => $book->id]);
        $query->setFetchMode(\PDO::FETCH_CLASS, get_class($instance));
        return $query->fetchAll();

    }

}
