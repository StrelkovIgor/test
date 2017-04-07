<?php

namespace app\models;

use Yii;
use yii\base\Model;



class regForm extends Model{
    
    public $name;
    public $phone;
    public $email;
    public $password;
    public $password_repeat;
    public $captcha;
    
    
    public function rules() {
        return [
            [['name','phone','email','password', 'captcha'], 'required','message'=>"Обязательное поле"],
            ['email', 'email', 'message'=>'Введите E-mail адрес'],
            ['password_repeat','compare', 'compareAttribute'=>'password', 'message'=>'Пароли не совпадают'],
            ['captcha', 'captcha', 'message'=>"Неверно введена капча"]
        ];
    }
}