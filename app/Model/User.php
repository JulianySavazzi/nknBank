<?php

namespace app\Model\User;

/*
 * tabela lead
 * nome
 * datanascimento
 * email
 * senha
 * whatsapp
 * datalog -> now
 * */
class User
{
    public int $id;
    public string $nome;
    public string $dataNascimento;
    public string $email;
    public string $senha;
    public string $whatsapp; /* formatar com máscara de celular */
    public string $dataLog; /* hora em que o registro foi salvo */
    public string $idade; /* apenas para fazer a validação da idade */

    
}