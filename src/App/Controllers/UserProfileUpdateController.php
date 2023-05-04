<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserProfileUpdateController extends BaseController
{

    public function index()
    {
        $userModel = new UserModel();
        $body = $this->getBody();
        try{
            $userModel->updateItem($body, $body['token']);
            $this->send(201, "Даныне пользователя обновлены", $body);
        }catch (\Exception $e){
            $this->send(400, "Не удалось обновить даныне пользователя");
        }
    }

    public function getValidateFields()
    {
        return [
            'login' => 'required|min:4',
            'email' => 'required|email',
            'phone' => 'required|min:5',
        ];
    }
}
