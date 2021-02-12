<?php
require_once ROOT."models/role.php";
require_once ROOT."models/status.php";
require_once ROOT."models/user.php";
$role = \Projet\Model\Role::getByName('Admin');
if(!$role)
{
    $role = new \Projet\Model\Role();
    $role->name = 'Admin';
    $role->save();
}
define('ADMIN', $role->id);
$role = \Projet\Model\Role::getByName('Client');
if(!$role)
{
    $role = new \Projet\Model\Role();
    $role->name = 'Client';
    $role->save();
}
define('CLIENT', $role->id);


$status = \Projet\Model\Status::getByName('En attente');
if(!$status)
{
    $status = new \Projet\Model\Status();
    $status->name = 'En attente';
    $status->save();
}
define('ATTENTE', $status->id);

$status = \Projet\Model\Status::getByName('Terminé');
if(!$status)
{
    $status = new \Projet\Model\Status();
    $status->name = 'Terminé';
    $status->save();
}
define('TERMINE', $status->id);

$status = \Projet\Model\Status::getByName('Annulé');
if(!$status)
{
    $status = new \Projet\Model\Status();
    $status->name = 'Annulé';
    $status->save();
}
define('ANNULE', $status->id);

$admin = \Projet\Model\User::getByLogin('admin');
if(!$admin)
{
    $admin = new \Projet\Model\User();
    $admin->login = 'admin';
    $admin->role_id = ADMIN;
    $admin->valid = 1;
    $admin->setPassword('admin');
    $admin->save();
    $_SESSION['message'] = 'Nous venons de créer un compte admin pour vous. Login: admin, Password: admin. N\'oubliez pas de changer votre mot de passe!';
}
