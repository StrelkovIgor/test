<?php

namespace app\models\users;

use yii\db\ActiveRecord;


class tbl_user extends ActiveRecord{
    
    public function rules() {
        return [
            [['email'], 'unique', 'message'=>'Такой E-mail уже существует'],
            [['name'], 'unique', 'message'=>'Такой логин уже существует']
        ];
    }
}
