<?php
require __DIR__.'/vendor/autoload.php';

//use app\Controller\UserController;

const DATABASE_HOST = "192.168.5.206";
const DATABASE_NAME = "nkn_bank";
const DATABASE_USER = "root";
const DATABASE_PASSWORD = "root";

//$timezone = new \DateTimeZone("America/Sao_Paulo");
$now = new \DateTime('now', new \DateTimeZone("America/Sao_Paulo"));
$bday = DateTime::createFromFormat("d/m/Y", "14/02/2000");

//var_dump(\app\Controller\Controller::checkIdade($bday, $now));


$now = new \DateTime('now', new \DateTimeZone("America/Sao_Paulo"));
$datalog = $now->format("Y/m/d H:i:s");

$connection = new PDO(
    "mysql:host=".DATABASE_HOST.";"."dbname=".DATABASE_NAME,
    DATABASE_USER,
    DATABASE_PASSWORD
);
$userController = new \app\Controller\UserController($connection);

var_dump(
    $userController->getUserByEmail("juliany_saz@hotmail.com"),
    $userController->getUserByEmail("brunosaz@hotmail.com"),
    $userController->getUserByEmail("oi@oi.com"),
);