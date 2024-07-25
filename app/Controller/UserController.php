<?php

namespace app\Controller;

use app\Controller\Controller;
use app\Model\User;
use PDO;

class UserController extends Controller
{

    public function __construct($connection)
    {
        parent::__construct($connection);
    }

    public function saveUser(User $user)
    {
        /* dados do usuario */
        $nome = $user->getNome();
        $dataNascimento = $user->getDataNascimento();
        $email = $user->getEmail();
        $senha = $user->getSenha();
        $whatsapp = $user->getWhatsapp();
        /* data e horario atual -> datalog */
        $now = new \DateTime('now', new \DateTimeZone("America/Sao_Paulo"));
        $datalog = $now->format("Y/m/d H:i:s"); /* mysql format */

        $insert = $this->connection->prepare("INSERT INTO lead 
            (nome, datanascimento, email, senha, whatsapp, datalog) 
            VALUES (?, ?, ?, ?, ?, ?)");

        $insert->bindParam(1, $nome);
        $insert->bindParam(2, $dataNascimento);
        $insert->bindParam(3, $email);
        $insert->bindParam(4, $senha);
        $insert->bindParam(5, $whatsapp);
        $insert->bindParam(6, $datalog); /* hora em que o registro foi salvo */
        $insert->execute();
    }

    public function getUserByEmail(string $email): int
    {
        $query = $this->connection->prepare("SELECT email FROM lead where email = ?");
        $query->execute([$email]);
        $rows = $query->rowCount();
        return $rows;
    }
}