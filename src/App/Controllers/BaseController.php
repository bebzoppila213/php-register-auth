<?php

namespace App\Controllers;

use Rakit\Validation\Validator;

abstract class BaseController
{
    private $validator;

    public function __construct()
    {
        $this->validator = new Validator;
    }

    protected function send($code, $messages, $data = []){
        header("HTTP/1.1 $code");
        header('Content-Type: application/json');
        echo json_encode(["status" => $code, "messages" => $messages, "data" => $data]);
        die();
    }

    abstract function getValidateFields();

    public function valiateBody(){
        $_BODY = $this->getBody();
        $validation = $this->validator->make($_BODY, $this->getValidateFields());
        $validation->validate();
        if($validation->fails()){
            $this->send(400, "Ошибка валидации");
        } 
    }

    public function getBody(){
        return json_decode(file_get_contents('php://input'), true);
    }
}
