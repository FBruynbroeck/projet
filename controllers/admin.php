<?php
namespace Projet\Controller;

class Admin extends \Projet\App\ControllerAdmin {

    public function index($id){
        header('Location: /');
        exit();
    }

    public function manage($id){
        if($id == 'users'){
            $title = "Utilisateurs";
            $this->loadModel('User');
            $users = $this->User::getAll();
            $view = 'users_manage';
            $this->render(compact('title', 'users', 'view'));
            exit();
        }
        if($id == 'items'){
            $title = "Articles";
            $this->loadModel('Item');
            $items = $this->Item::getAll();
            $view = 'items_manage';
            $this->render(compact('title', 'items', 'view'));
            exit();
        }
        if($id == 'books'){
            $title = "Commandes";
            $this->loadModel('Book');
            $books = $this->Book::getAll();
            $view = 'books_manage';
            $this->render(compact('title', 'books', 'view'));
            exit();
        }
        header('Location: /');
        exit();
    }

    public function new($id){
        if($id == 'user'){
            if(isset($_POST['login']) && isset($_POST['password'])){
                $this->loadModel('User');
                if($this->User::getByLogin($_POST['login'])){
                    $_SESSION['error'] = "L'utilisateur existe déjà";
                }
                else {
                    $this->User->login = $_POST['login'];
                    $this->User->setPassword($_POST['password']);
                    $this->User->email = $_POST['email'];
                    $this->User->valid = 1;
                    $this->User->role_id = CLIENT;
                    $this->User->save();
                    $_SESSION['message'] = 'L\'utilisateur '.$this->User->login.' a bien été enregistré.';
                    header('Location: /');
                    exit();
                }
            }
            $title = 'Nouvel utilisateur';
            $view = 'signup';
            $this->render(compact('title', 'view'));
            exit();
        }
        if($id == 'item'){
            if(isset($_POST['title']) && isset($_POST['price'])){
                $this->loadModel('Item');
                if($this->Item::getByTitle($_POST['title'])){
                    $_SESSION['error'] = "L'article existe déjà";
                }
                else {
                    if($_FILES['image']){
                        $status = $this->Item->upload($_FILES['image']);
                        if($status !== true){
                            $_SESSION['error'] = 'Impossible de charger l\'image: '.$status;
                            exit();
                        }
                    }
                    $this->Item->title = $_POST['title'];
                    $this->Item->price = $_POST['price'];
                    $this->Item->description = $_POST['description'];
                    $this->Item->valid = 1;
                    $this->Item->image = $_FILES["image"]["name"];
                    $this->Item->save();
                    $_SESSION['message'] = 'L\'article '.$this->Item->title.' a bien été enregistré.';
                    header('Location: /');
                    exit();
                }
            }
            $title = 'Nouvel article';
            $view = 'item_new';
            $this->render(compact('title', 'view'));
            exit();
        }
        header('Location: /');
        exit();
    }

    public function edit_user($login){
        $title = "Modifier l'utilisateur";
        $this->loadModel('User');
        $user = $this->User::getByLogin($login);

        if (!empty($_POST) && !empty($_POST['login']) && !empty($_POST['email'])){
            if($_POST['password'] != $_POST['confirm_password'])
            {
                $_SESSION['error'] = "Votre mot de passe et votre mot de passe de confirmation ne correspondent pas...";
            }
            else
            {
                if(!$user){
                    $_SESSION['error'] = "L'utilisateur ".$login." n'existe pas.";
                    header('Location: /');
                    exit();
                }
                $user->email = $_POST['email'];
                $user->login = $_POST['login'];
                if($_POST['password']){
                    $user->setPassword($_POST['password']);
                }
                $user->update();
                $_SESSION['message'] = 'L\'utilisateur '.$user->login.' a bien été mis à jour';
                header('Location: /admin/'.$user->login.'/edit_user');
                exit();
            }
        }
        $view = 'user_edit';
        $this->render(compact('title', 'user', 'view'));
    }

    public function delete_user($login){
        $this->loadModel('User');
        $user = $this->User::getByLogin($login);
        if(!$user){
            $_SESSION['error'] = "L'utilisateur ".$login." n'existe pas.";
            header('Location: /');
            exit();
        }
        $user->valid = 0;
        $user->update();
        $_SESSION['message'] = 'L\'utilisateur '.$user->login.' a bien été supprimé';
        header('Location: /');
        exit();
    }

    public function enable_user($login){
        $this->loadModel('User');
        $user = $this->User::getByLogin($login);
        if(!$user){
            $_SESSION['error'] = "L'utilisateur ".$login." n'existe pas.";
            header('Location: /');
            exit();
        }
        $user->valid = 1;
        $user->update();
        $_SESSION['message'] = 'L\'utilisateur '.$user->login.' a bien été réactivé';
        header('Location: /');
        exit();
    }

    public function edit_item($title){
        $this->loadModel('Item');
        $item = $this->Item::getByTitle($title);
        if(!$item){
            $_SESSION['error'] = "L'article ".$title." n'existe pas.";
            header('Location: /');
            exit();
        }
        if (!empty($_POST)){
            if($_FILES['image']["name"]){
                $status = $item->upload($_FILES['image']);
                if($status === true){
                    $item->image = $_FILES["image"]["name"];
                    $item->update();
                }
                else{
                    $_SESSION['error'] = 'Impossible de charger l\'image: '.$status;
                }
            }
            $item->title = $_POST['title'];
            $item->price = $_POST['price'];
            $item->description = $_POST['description'];
            $item->update();
            $_SESSION['message'] = 'L\'article '.$item->title.' a bien été mis à jour';
            header('Location: /admin/'.$item->title.'/edit_item');
            exit();
        }
        $title = "Modifier l'article";
        $view = 'item_edit';
        $this->render(compact('title', 'item', 'view'));
    }

    public function delete_item($title){
        $this->loadModel('Item');
        $item = $this->Item::getByTitle($title);
        if(!$item){
            $_SESSION['error'] = "L'article ".$title." n'existe pas.";
            header('Location: /');
            exit();
        }
        $item->valid = 0;
        $item->update();
        $_SESSION['message'] = 'L\'article '.$item->title.' a bien été supprimé';
        header('Location: /');
        exit();
    }

    public function enable_item($title){
        $this->loadModel('Item');
        $item = $this->Item::getByTitle($title);
        if(!$item){
            $_SESSION['error'] = "L'article ".$title." n'existe pas.";
            header('Location: /');
            exit();
        }
        $item->valid = 1;
        $item->update();
        $_SESSION['message'] = 'L\'article '.$item->title.' a bien été réactivé';
        header('Location: /');
        exit();
    }

    public function validate_book($id){
        $this->loadModel('Book');
        $book = $this->Book::getByPk($id);
        if(!$book){
            $_SESSION['error'] = "La commande ".$id." n'existe pas.";
            header('Location: /');
            exit();
        }
        $book->status_id = TERMINE;
        $book->update();
        $_SESSION['message'] = 'La commande '.$book->id.' est validée';
        header('Location: /admin/books/manage');
        exit();
    }

    public function cancel_book($id){
        $this->loadModel('Book');
        $book = $this->Book::getByPk($id);
        if(!$book){
            $_SESSION['error'] = "La commande ".$id." n'existe pas.";
            header('Location: /');
            exit();
        }
        $book->status_id = ANNULE;
        $book->update();
        $_SESSION['message'] = 'La commande '.$book->id.' est annulée';
        header('Location: /admin/books/manage');
        exit();
    }

}
