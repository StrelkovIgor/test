<?php

namespace app\models;

use yii\db\ActiveRecord;


class tbl_user extends ActiveRecord{
    
    public $name_role;
    
    public function rules() {
        return [
            [['email'], 'unique', 'message'=>'Такой E-mail Уже существует']
        ];
    }
}
