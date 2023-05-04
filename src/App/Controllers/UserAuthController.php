<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserAuthController extends BaseController
{

    public function index()
    {
        $userModel = new UserModel();
        $body = $this->getBody();
        try {
            $resultItem = $userModel->getItem($body['login'], $body['password']);
            $this->send(200, "Пользователь успешно авторизован", $resultItem);
        } catch (\Exception $e) {
            $this->send(400, $e->getMessage(), $resultItem);
        }
    }

    public function getValidateFields()
    {
        return [
            'login'                 => 'required|min:4',
            'password'              => 'required|min:4',
        ];
    }
}
