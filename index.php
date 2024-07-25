<?php
/* carregamento automatico */
require __DIR__.'/vendor/autoload.php';

use app\Controller;
use app\Model;

const DATABASE_HOST = "192.168.5.206";
const DATABASE_NAME = "nkn_bank";
const DATABASE_USER = "root";
const DATABASE_PASSWORD = "root";

/* formatar data -> date mysql */
const DATE_BR = "d/m/Y";

/* data e horario atual -> datalog */
$timezone = new \DateTimeZone("America/Sao_Paulo");
$now = new \DateTime('now', $timezone);

/* conexao com banco de dados */
$connection = new PDO(
        "mysql:host=".DATABASE_HOST.";"."dbname=".DATABASE_NAME,
    DATABASE_USER,
    DATABASE_PASSWORD
);

var_dump(
    $_POST,
//    $now
);

/* pagina de cadastro */
include __DIR__."/form_cadastro.php";

$userController = new Controller\UserController($connection);
$user = new Model\User(
    "",
    "",
    "",
    "",
    ""
);

try {
    /* Dados do usuario vindos do formulario */
//    $name = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
    $user->setNome((string)filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS));

    $birthDate = DateTime::createFromFormat(DATE_BR,
        (string)filter_input(INPUT_POST, "dataNascimento", FILTER_DEFAULT), $timezone);
    $user->setDataNascimento((string)filter_input(INPUT_POST, "dataNascimento", FILTER_DEFAULT));

//if(Controller\Controller::checkIdade(!empty($_POST["dataNascimento"]), $now) > 18) $birthDate =
//    DateTime::createFromFormat(DATE_BR,
//     filter_input(INPUT_POST, "dataNascimento", FILTER_DEFAULT), $timezone);
//elseif(Controller\Controller::checkIdade(!empty($_POST["dataNascimento"]), $now) < 18){
//    echo "
//        <div
//        style='background-color: rosybrown'
//        >
//            <p style='text-align: center' >Você precisa ter mais de 18 anos!</p>
//        </div>
//    ";
//}

    if(!empty($_POST["email"]) &&
        filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL) && $userController->getUserByEmail((string)$_POST["email"]) === 0){
         $user->setEmail(filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL));
    } elseif(!empty($_POST["email"]) && $userController->getUserByEmail((string)$_POST["email"]) > 0) {
        echo "
        <div
        style='background-color: rosybrown'
        >
            <p style='text-align: center' >Já existe uma conta com esse email!</p>
        </div>";
    } else {
        if(!empty($_POST["email"])){
            echo "
            <div
            style='background-color: rosybrown'
            >
                <p style='text-align: center' >Insira um email válido!</p>
            </div>";
        }
    }

    if(!empty($_POST["senha"])  && Controller\Controller::checkPass((string)$_POST["senha"]))
//        $password = filter_input(INPUT_POST, "senha", FILTER_DEFAULT);
        $user->setSenha(filter_input(INPUT_POST, "senha", FILTER_DEFAULT));
    elseif(!empty($_POST["senha"])) {
        echo "
        <div
        style='background-color: rosybrown'
        >
            <h2 style='text-align: center'>ERRO:</h2>
            <p style='text-align: center' >A senha precisa ter pelo menos 6 caracteres, use letras e números!</p>
        </div>";
    }

//    $whatsapp = filter_input(INPUT_POST, "whatsapp", FILTER_DEFAULT);
    $user->setWhatsapp((string)filter_input(INPUT_POST, "whatsapp", FILTER_DEFAULT));

    /* salvar dados na tabela lead*/
    var_dump(
        $userController->getUserByEmail((string)$_POST["email"]),
        $user->getNome(),
        $user->getDataNascimento(),
        $user->getEmail(),
        $user->getSenha()
    );

    if(!empty($user->getNome()) && !empty($user->getDataNascimento() && !empty($user->getEmail()) && !empty
            ($user->getSenha()))){
        try{
            $userController->saveUser($user);
            echo "
                <div
                style='background-color: skyblue'
                >
                    <h2 style='text-align: center'>Obrigado!</h2>
                </div>
            ";
        } catch (PDOException $e){
            echo "
            <div
            style='background-color: rosybrown'
            >
                <h2 style='text-align: center'>ERRO AO SALVAR DADOS:</h2>
                <p style='text-align: center' >{$e}</p>
            </div>";
        }
    } else {
        echo "
        <div
        style='background-color: rosybrown'
        >
            <h2 style='text-align: center'>OS CAMPOS OBRIGATÓRIOS PRECISAM SER PREENCHIDOS!</h2>
            <p style='text-align: center' > Nome, Data de Nascimento, E-mail e Senha são obrigatórios!</p>
        </div>";
    }

} catch (Exception $e) {
    echo "
        <div
        style='background-color: rosybrown'
        >
            <h2 style='text-align: center'>ERRO INESPERADO:</h2>
            <p style='text-align: center' >{$e}</p>
        </div>";
}










