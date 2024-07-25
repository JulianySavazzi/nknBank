<?php

namespace app\Controller;

use PDO;
use PDOException;
use DateTime;
use DateTimeZone;

/*
* PDO("mysql:host=myhost;dbname=mydb", "root", "password");
* */
class Controller
{
    protected PDO $connection;

    protected function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public static function verifyConnection($connection): bool
    {
        try {
            if($connection) echo "<h1>Conectado com sucesso!</h1>";
            return true;
        } catch (PDOException $e) {
            var_dump($connection);
            return false;
        }
    }

    protected function getConnection(): PDO
    {
        return $this->connection;
    }

    protected function setConnection(PDO $connection): void
    {
        $this->connection = $connection;
    }

    public static function checkIdade(DateTime $birthDate, DateTime $now)
    {
        return $now->diff($birthDate)->y;
    }

    public static function checkPass($password): bool
    { /* pelo menos 6 caracteres e 1 numero */

        $check = str_contains($password, "0") ||
            str_contains($password, "1") ||
            str_contains($password, "2") ||
            str_contains($password, "3") ||
            str_contains($password, "4") ||
            str_contains($password, "5") ||
            str_contains($password, "6") ||
            str_contains($password, "7") ||
            str_contains($password, "8") ||
            str_contains($password, "9");
        if(strlen($password) > 5 && $check ) return true;
        else return false;
    }
}