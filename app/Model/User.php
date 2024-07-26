<?php

namespace app\Model;

/*
 * tabela lead
 * nome
 * datanascimento
 * email
 * senha
 * whatsapp
 * datalog -> now
 * */

use app\Controller\UserController;

class User
{
//    public int $id;
    public string $nome;
    public string $dataNascimento;
    public string $email;
    public string $senha;
    public string $whatsapp;

    public function __construct($nome, $dataNascimento, $email, $senha, $whatsapp = null)
    {
        $this->nome = $nome;
        $this->dataNascimento = $dataNascimento;
        $this->email = $email;
        $this->senha = $senha;
        $this->whatsapp = $whatsapp;
    }

//    public function getId(): int
//    {
//        return $this->id;
//    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getDataNascimento(): string
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento(string $dataNascimento): void
    {
        $this->dataNascimento = $dataNascimento;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function setSenha(string $senha): void
    {
        $this->senha = $senha;
    }

    public function getWhatsapp(): string
    {
        return $this->whatsapp;
    }

    public function setWhatsapp(string $whatsapp): void
    {
        $this->whatsapp = $whatsapp;
    }

}