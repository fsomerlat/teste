<?php

/**
 * O padrão Builder sugere que você extraia o código de construção do objeto para fora de
 * csua própria classe e mova ele para objetos separados chamados builders.
*/

namespace App\Builder;

use App\Entity\User;

class UserBuilder
{
    private $usuario;

    public function __construct()
    {
        $this->usuario = new User();
    }

    public function setName(string $name): self
    {
        $this->usuario->setName($name);
        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->usuario->setEmail($email);
        return $this;
    }

    public function build(): User
    {
        return $this->usuario;
    }
}