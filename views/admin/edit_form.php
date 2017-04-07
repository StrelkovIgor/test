<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
?> 
<div class="container">
    <h1>Изменение пользователя</h1>
    <div class="row">
        <div class="col-md-6">

<?php
    $role_id = [0=> '-'];
    foreach($role as $v) $role_id[$v->id] = $v->title;
    $action = [];
    if(in_array($user->role_id, $role_id)) $action[$user->role_id] = $role_id[$user->role_id];
            $form = ActiveForm::begin();
                echo $form->field($edit_user, 'name')->label('Логин')->textInput(['value'=>$user->name]);
                echo $form->field($edit_user, 'phone')->label('Телефон')->textInput(['value'=>$user->phone]);
                echo $form->field($edit_user, 'email')->label('E-mail')->textInput(['value'=>$user->email]);
                echo $form->field($edit_user, 'role_id')->dropDownList($role_id,['options' =>[ $user->role_id => ['Selected' => true]]])->label('Роль');
                echo Html::submitButton("Изменить",['class'=>"btn btn-defaul"]);
            ActiveForm::end();
        ?>
       </div>
        <div class="col-md-6"></div>
    </div>
</div>