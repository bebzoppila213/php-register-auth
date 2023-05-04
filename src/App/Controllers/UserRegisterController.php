<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserRegisterController extends BaseController
{

    public function index()
    {
        $userModel = new UserModel();
        $body = $this->getBody();
        try{
            $userToken = $userModel->create($body['email'], $body['login'], $body['phone'], $body['password']);
            $this->send(201, "Пользователь успешно создан", ["token" => $userToken]);
        }catch(\Exception $e){
            $this->send(400, "Не удалось создать пользователя, возможно такой пользователь уже существует");
        }
    }

    public function getValidateFields()
    {
        return [
            'login'                 => 'required|min:4',
            'email'                 => 'required|email',
            'password'              => 'required|min:4',
            'repeatPassword'        => 'required|same:password',
            'phone'                 => 'required|min:5',
        ];
    }
}
