<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
//use yii\swiftmailer\Mailer;

#model
use app\models\regForm;
use app\models\login;
use app\models\tbl_user;

#components
use app\components\Users;

class IndexController extends Controller
{
   public function __construct($id, $module, $config = array()) {
       parent::__construct($id, $module, $config);
   }
   
   public function actionIndex(){
       return $this->render('index');
   }
   
   public function actionReg(){

       $form = new regForm();
       $exe = $errorMessage = null;
       if($form->load(Yii::$app->request->post()) && $form->validate()){
            $user = new Users();
            $user->add_user(['name'=>$form->name,'phone'=>$form->phone,'email'=>$form->email,'password'=>$user->genn_pass($form->password)]);
            if(!count($user->error)){
                $exe = "Вы зарегестрировались. Вам отправлено письмо для проверки вашего E-mail.";
                $url = Yii::$app->urlManager->createUrl(['index/regtest','user'=>$user->last_id, 'hach'=>$user->hash_test_email($user->last_id,$form->email)]);
                $user->email_user('Регистрация пользователя', 'Ссылка потверждения E-maila: <a href="'.$url.'">'.$url.'</a>');
            }else{
                $errorMessage = $user->error;
            }
            var_dump($errorMessage);
       }
       return $this->render('regform',[
           'regForm' => $form,
           'testReg' => $exe,
           'errorMessage' =>$errorMessage
       ]);
   }
   
   public function actionRegtest(){
       $id = Yii::$app->request->get('user');
       $hash = Yii::$app->request->get('hach');
       
       $user = new Users();
       return $this->render('emailtest',[
           'exeits' => $user->act_reg($id, $hash)
       ]);
       
   }
   
   public function actionLogin(){
       $user = new Users();
       
       if($user->is_login()) $this->redirect ('/');
       $login = new login();
       
       $error = null;
       if($login->load(Yii::$app->request->post()) && $login->validate()){
           $error = "Неверный логин или пароль";
           $post = Yii::$app->request->post('login');
           if($user->login($post['name'], $post['password'])){
               $this->redirect('/');
           }
           
       }
       
       return $this->render('login',[
           'login' => $login,
           'error' => $error
               
       ]);
   }
   
   public function actionLoginout(){
       $user = new Users();
       $user->loginout();
       return $this->redirect(Yii::$app->request->referrer);
   }
   

}
