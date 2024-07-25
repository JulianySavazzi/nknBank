<?php
/* carregamento automatico */
require __DIR__.'/vendor/autoload.php';

use app\Controller;
use app\Model;

const DATABASE_HOST = "192.168.5.206";
const DATABASE_NAME = "nkn_bank";
const DATABASE_USER = "root";
const DATABASE_PASSWORD = "root";

/* data e horario atual -> datalog */
$timezone = new \DateTimeZone("America/Sao_Paulo");
$now = new \DateTime('now', $timezone);

/* conexao com banco de dados */
$connection = new PDO(
        "mysql:host=".DATABASE_HOST.";"."dbname=".DATABASE_NAME,
    DATABASE_USER,
    DATABASE_PASSWORD
);

/* pagina de cadastro */
include __DIR__."/form_cadastro.php";

/* inicializando objetos para manipular usuarios */
$userController = new Controller\UserController($connection);
$user = new Model\User(
    "",
    "",
    "",
    "",
    ""
);

/* manipulação dos dados do usuario */
try {
    /* Dados do usuario vindos do formulario */
    $user->setNome((string)filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS));

    if(!empty($_POST["dataNascimento"]) &&
        Controller\Controller::checkIdade(new DateTime($_POST["dataNascimento"]), $now) >= 18)
    {
        $user->setDataNascimento((string)filter_input(INPUT_POST, "dataNascimento", FILTER_DEFAULT));
    } elseif(!empty($_POST["dataNascimento"]) &&
        Controller\Controller::checkIdade(new DateTime($_POST["dataNascimento"]), $now) < 18)
    {
        echo "
            <div
            style='background-color: rosybrown'
            class='flex flex-auto flex-col ml-10 mr-10 mt-0 mb-10 p-5 rounded-full'
            >
                <p style='text-align: center' >Você precisa ter mais de 18 anos!</p>
            </div>
        ";
    }

    if(!empty($_POST["email"]) &&
        filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL) && $userController->getUserByEmail((string)$_POST["email"]) === 0){
         $user->setEmail(filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL));
    } elseif(!empty($_POST["email"]) && $userController->getUserByEmail((string)$_POST["email"]) > 0) {
        echo "
        <div
        style='background-color: rosybrown'
        class='flex flex-auto flex-col ml-10 mr-10 mt-0 mb-10 p-5 rounded-full'
        >
            <p style='text-align: center' >Já existe uma conta com esse email!</p>
        </div>";
    } else {
        if(!empty($_POST["email"])){
            echo "
            <div
            style='background-color: rosybrown'
            class='flex flex-auto flex-col ml-10 mr-10 mt-0 mb-10 p-5 rounded-full'
            >
                <p style='text-align: center' >Insira um email válido!</p>
            </div>";
        }
    }

    if(!empty($_POST["senha"])  && Controller\Controller::checkPass((string)$_POST["senha"]))
        $user->setSenha(filter_input(INPUT_POST, "senha", FILTER_DEFAULT));
    elseif(!empty($_POST["senha"])) {
        echo "
        <div
        style='background-color: rosybrown'
        class='flex flex-auto flex-col ml-10 mr-10 mt-0 mb-10 p-5 rounded-full'
        >
            <h2 style='text-align: center'>ERRO:</h2>
            <p style='text-align: center' >A senha precisa ter pelo menos 6 caracteres, use letras e números!</p>
        </div>";
    }

    $user->setWhatsapp((string)filter_input(INPUT_POST, "whatsapp", FILTER_DEFAULT));

    /* salvar dados na tabela lead*/
    if(!empty($user->getNome()) && !empty($user->getDataNascimento() && !empty($user->getEmail()) && !empty
            ($user->getSenha()))){ /* verificando se os dados a ser salvos nao sao vazios */
        try{
            $userController->saveUser($user);
            echo "
                <div
                style='background-color: skyblue'
                class='flex flex-auto flex-col ml-10 mr-10 mt-0 mb-10 p-5 rounded-full'
                >
                    <h2 style='text-align: center'>Obrigado!</h2>
                    <p style='text-align: center'>Espere o redirecionamento...</p>
                </div>
                <script>
                    setTimeout(() => {
                        window.location.href = 'https://nknbank.com.br'
                    }, 2500)
                </script>
            ";
        } catch (PDOException $e){
            echo "
            <div
            style='background-color: rosybrown'
            class='flex flex-auto flex-col ml-10 mr-10 mt-0 mb-10 p-5 rounded-full'
            >
                <h2 style='text-align: center'>ERRO AO SALVAR DADOS:</h2>
                <p style='text-align: center' >{$e}</p>
            </div>";
        }
    } else {
        echo "
        <div
        style='background-color: lemonchiffon'
        class='flex flex-auto flex-col ml-10 mr-10 mt-0 mb-10 p-5 rounded-full'
        >
            <div class='justify-content-center justify-items-center items-center'>
                <h2 style='text-align: center'>ATENÇÃO</h2>
            </div>
            <p style='text-align: center' > Nome, Data de Nascimento, E-mail e Senha são obrigatórios.</p>
            <p style='text-align: center'>Precisam ser preenchidos!</p>
        </div>";
    }

} catch (Exception $e) {
    echo "
        <div
        style='background-color: rosybrown'
        class='flex flex-auto flex-col ml-10 mr-10 mt-0 mb-10 p-5 rounded-full'
        >
            <h2 style='text-align: center'>ERRO INESPERADO:</h2>
            <p style='text-align: center' >{$e}</p>
        </div>";
}










