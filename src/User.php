<?php
namespace App;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{

    private $name;

    public function __construct($name = 'guest')
    {
        $this->name = $name;
    }

    public function getRoles()
    {
        return ["ROLE_USER"];
    }

    public function getPassword()
    {
        return "password";
    }

    public function getSalt() {
        return "H3dIuRpqA";
    }


    public function getUsername()
    {
        return $this->name;
    }

    public function eraseCredentials()
    {
        return;
    }
}