<?php

namespace App\Models;
use App\Config;
use App\Models\BaseModel;

class UserModel extends BaseModel
{

    public function create($email, $login, $phone, $password)
    {
        $userToken = bin2hex(random_bytes(30));
        $query = $this->builder
            ->insert()
            ->setTable('user')
            ->setValues([
                'email' => $email,
                'login' => $login,
                'phone' => $phone,
                'password' => md5(Config::$passwordSail . $password),
                'token' => $userToken,
            ]);
        $this->db->query($this->builder->writeFormatted($query), $this->builder->getValues());
        return $userToken;
    }

    public function getItem($login, $password)
    {
        $query = $this->builder
            ->select()
            ->setTable('user')
            ->setColumns([
                'id'    => 'id',
                'email' => 'email',
                'login' => 'login',
                'phone' => 'phone',
                'token' => 'token',
            ])
            ->where()
            ->equals('password', md5('awdnb546j' . $password))
            ->subWhere("OR")
            ->equals('login', $login)
            ->equals('email', $login)
            ->end();
        return $this->getElementByParams($this->builder->writeFormatted($query), $this->builder->getValues());
    }

    public function getItemByToken($token)
    {
        $query = $this->builder
            ->select()
            ->setTable('user')
            ->setColumns([
                'id'    => 'id',
                'email' => 'email',
                'login' => 'login',
                'phone' => 'phone',
                'token' => 'token',
            ])
            ->where()
            ->equals('token', $token)
            ->end();
        return $this->getElementByParams($this->builder->writeFormatted($query), $this->builder->getValues());
    }

    public function updateItem($values, $token)
    {
        $query = $this->builder
            ->update()
            ->setTable('user')
            ->setValues($values)
            ->where()
            ->equals('token', $token)
            ->end();
        $this->db->query($this->builder->writeFormatted($query), $this->builder->getValues());
    }
}
