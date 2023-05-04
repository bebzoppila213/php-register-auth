<?php

namespace App\Models;

use App\DataBase\DataBase;
use NilPortugues\Sql\QueryBuilder\Builder\GenericBuilder;
use App\Config;

class BaseModel
{

    protected $db;
    protected $builder;
    
    public function __construct()
    {
        $this->db = new DataBase(Config::$dbConfig['name'], Config::$dbConfig['host'], Config::$dbConfig['login'], Config::$dbConfig['password']);
        $this->builder = new GenericBuilder();
    }

    protected function getElementByParams($query, $values){
        $sth = $this->db->query($query, $values);
        $res = $sth->fetch(\PDO::FETCH_ASSOC);
        if ($res == false) {
            throw new \Exception("Пользователя не существует");
        }
        return $res;
    }
}
