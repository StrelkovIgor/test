<?php

namespace app\components;

use Yii;

#models
use app\models\users\tbl_user;

class Users{
    
    private $format_user = ['id'=>null, 'name'=>null, 'phone'=>null, 'email'=>null, 'password'=>null, 'role_id'=>0];
    public $error = [];
    public $last_id = null;
    public $session = null;
    
    public function __construct() {
        $this->session = Yii::$app->session;
    }
    
    public function hash_test_email($id,$email){
        return md5($id.md5($email));
    }
    
    public function genn_pass($pass){
        return Yii::$app->getSecurity()->generatePasswordHash($pass);
    }
    
    public function add_user($data = null){
        if(!$data) return false;
        foreach($this->format_user as $k=>$v) if(isset($data[$k])) $this->format_user[$k] = $data[$k];
        
        $user = new tbl_user();
        foreach($this->format_user as $k=>$v) $user->$k = $v;
        if($user->validate()){
            $user->save();
            $this->last_id = $user->id;
            return true;
        }else{
            foreach($user->getErrors() as $error) $this->error[] = $error[0];
            return false;
        }
    }
    
    public function act_reg($id,$hash){
        $user = tbl_user::find()->where(['id'=>$id])->one();
        if($user && $hach==$this->hash_test_email($user->id, $user->email)){
            $user->role_id = 2;
            $user->save();
            return true;
        }else return false;
        
    }
    
    public function email_user($title, $messageHTML, $id_user = null){
        $id_user = (($id_user)?$id_user:$this->last_id);
        
        if(!$id_user){
            $this->error[] = "Не найден id пользователя";
            return false;
        }
        $user = tbl_user::find()->where(['id'=>$id_user])->one();
        Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setTo($user->email)
            ->setSubject($title)
            ->setHtmlBody($messageHTML)
            ->send();
        return true;
    }
    
    public function login($login, $pass){
        $user = tbl_user::find()->where(['name'=>$login])->andWhere('role_id>0')->one();
        
        if($user){
            if(Yii::$app->getSecurity()->validatePassword($pass, $user->password)){
                $this->session->set('user', $user);
                return true;
            }
        }
        return false;
        
    }
    
    public function is_login(){
        
        return !is_null($this->get_login());
        
    }
    public function get_login(){
        return $this->session->get('user');
    }
    
    public function is_role($num = 0){
        $user = $this->get_login();
        return $user && $num == $user->role_id;
    }
    public function loginout(){
        $this->session->remove('user');
    }
    
    public function deleteUser($id){
        $user = tbl_user::find()->where(['id'=>$id])->one();
        $user->delete();
    }

}