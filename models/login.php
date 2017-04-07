<?php

namespace app\models;

use Yii;
use yii\base\Model;



class login extends Model{
    
    public $name;
    public $password;
    
    
    public function rules() {
        return [
            [['name','password'], 'required','message'=>"Обязательное поле"]
        ];
    }
}