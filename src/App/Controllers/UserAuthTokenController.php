<?php

namespace App\Controllers;
use App\Models\UserModel;

class UserAuthTokenController extends BaseController
{

    public function index()
    {
        $body = $this->getBody();
        $userModel = new UserModel();
        try{
            $user = $userModel->getItemByToken($body['token']);
            $this->send(200, "Пользователь успешно авторизован", $user);
        }catch(\Exception $e){
            $this->send(400, "не удалось пройти авторизацию");
        }
       
    }

    public function getValidateFields()
    {
        return [
            'token' => 'required|min:4',
        ];
    }
}
