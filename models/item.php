<?php
namespace Projet\Model;


class Item extends \Projet\App\Model {
    public $quantity;
    protected $columns = ['id', 'title', 'price', 'description', 'valid', 'image'];

    public function total() {
        return $this->price * $this->quantity;
    }
    public function getAvailable(){
        $query = $this->_pdo->prepare("select * from ".$this->table." where valid = 1");
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, get_class($this));
        return $query->fetchAll();
    }

    public static function getByTitle($title){
        $instance = new static();
        $query = $instance->_pdo->prepare("select * from ".$instance->table." where title = :title");
        $query->execute([':title' => $title]);
        $query->setFetchMode(\PDO::FETCH_CLASS, get_class($instance));
        return $query->fetch();
    }

    public function upload($file) {
        $target_dir = "downloads/";
        $target_file = $target_dir . basename($file["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
          $check = getimagesize($file["tmp_name"]);
          if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
          } else {
            return "File is not an image.";
          }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
          return "Sorry, file already exists.";
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
          return "Sorry, your file is too large.";
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
          return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          return "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($file["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $file["name"])). " has been uploaded.";
            return true;
          } else {
            return "Sorry, there was an error uploading your file.";
          }
        }
    }

}
