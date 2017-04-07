<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
//use yii\swiftmailer\Mailer;
use yii\data\Pagination;

#model
use app\models\tbl_user;
use app\models\admin\form\editUser;
use app\models\admin\filter;

#components
use app\components\Users;

class AdminController extends Controller
{
    public $users = null;
    private $noenter = '/admin/noindex';
    
    public function __construct($id, $module, $config = array()) {
        parent::__construct($id, $module, $config);
        $this->users = new Users();
        if(!$this->users->is_role(1) && Yii::$app->request->url!=$this->noenter) $this->redirect ($this->noenter);
    }
    
    public function actionIndex(){
        $user = tbl_user::find()->select('tbl_user.*, tbl_role.title as name_role')->leftJoin('tbl_role','tbl_user.role_id=tbl_role.id')->orderBy('id desc');
        $filter = new filter();
        $role = \app\models\users\tbl_role::find()->all();
        $post = null;
        if($filter->load(Yii::$app->request->post()) && $filter->validate()){
            $post = Yii::$app->request->post('filter');
            $data = [];
            if($post['text']){
                $text = explode(" ", $post['text']);
                foreach($text as $value){
                    foreach(['name','phone','email'] as $tbl){
                        $data[] = $tbl." LIKE '%".$value."%'";
                    }
                }
            }
            $user->andWhere(((count($data))?'('.implode(" OR ", $data).') AND':'')." role_id='".$post['role_id']."'");
        }
        
        $pagination = new Pagination([
            'defaultPageSize'=>20,
            'totalCount'=> $user->count()
        ]);
        
        $user = $user->offset($pagination->offset)->limit($pagination->limit)->all();
        
        return $this->render('list_user',[
            'user'=>$user,
            'pagination'=> $pagination,
            'filter' => $filter,
            'role'=>$role,
            'post'=>$post
        ]);
    }
    
    public function actionNoindex(){
        return $this->render('no_enter');
    }
    
    public function actionEdit(){
        $user = tbl_user::find()->where(['id'=>Yii::$app->request->get('id')])->one();
        $role = \app\models\users\tbl_role::find()->all();
        $edit_user = new editUser();
        
        if($edit_user->load(Yii::$app->request->post()) && $edit_user->validate()){
            $post = Yii::$app->request->post('editUser');
            $user->name = $post['name'];
            $user->phone = $post['phone'];
            $user->email = $post['email'];
            $user->role_id = $post['role_id'];
            $user->save();
        }
        
        return $this->render('edit_form',[
            'edit_user' => $edit_user,
            'role'=>$role,
            'user'=>$user
        ]);
    }
    
    public function actionDelete(){
        $this->users->deleteUser(Yii::$app->request->get('id'));
        $this->redirect(Yii::$app->request->referrer);
    }

}
