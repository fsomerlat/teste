<?php

/**
 * Composite é um padrão estrutural que permite compor objetos em estruturas de árvore para representar hierarquias. Ele permite que 
 * os clientes tratem objetos individuais e composições de objetos de maneira uniforme. Isso significa que você pode trabalhar com um único objeto ou um grupo de 
 * objetos.
*/
namespace App\Composite;

use App\Entity\User;

class Grupo
{
    private $usuarios = [];

    public function addUser(User $user): void
    {
        $this->usuarios[] = $user;
    }

    public function getUsers(): array
    {
        return $this->usuarios;
    }
}