<?php

class UserEntity
{
    private $id;
    private $username;
    private $email;
    private $password;
    private $role;
    private $address;
    private $birth_date;


    function __construct($id, $username, $email, $password, $role, $address, $birth_date)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->address = $address;
        $this->birth_date = $birth_date;
    }

    function getId()
    {
        return $this->id;
    }
    function getUsername()
    {
        return $this->username;
    }
    function getEmail()
    {
        return $this->email;
    }
    function getPassword()
    {
        return $this->password;
    }
    function getRole()
    {
        return $this->role;
    }
    function getAddress()
    {
        return $this->address;
    }
    function getBirth_Date()
    {
        return $this->birth_date;
    }


    function __tostring()
    {
        return "User: " . $this->username . " - " . $this->email;
    }
}

?>