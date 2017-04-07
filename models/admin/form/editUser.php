<?php

namespace app\models\admin\form;

use Yii;
use yii\base\Model;



class editUser extends Model{
    
    public $name;
    public $phone;
    public $email;
    public $role_id;
    
    
    public function rules() {
        return [
            [['name','phone','email','role_id'], 'required','message'=>"Обязательное поле"],
            ['email', 'email', 'message'=>'Введите E-mail адрес'],
        ];
    }
}