<?php

namespace App\DataBase;

class DataBase
{

    private $connect;

    public function __construct($dbName, $host, $login, $password )
    {   
        $this->connect = new \PDO("mysql:dbname=$dbName;host=$host", $login, $password);    
    }

    public function query($query, $values){
        $sth = $this->connect->prepare($query);
        $sth->execute($values);
        return $sth;
    }

}
