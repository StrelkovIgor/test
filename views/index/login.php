<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

?>
<div class="container">
    <h1>Авторизация</h1>
    <div class="row">
        <?=(($error)?'<p style="color:red;">'.$error.'</p>':'')?>
        <div class="col-md-6">  
        <?php
            $form = ActiveForm::begin();

            echo $form->field($login, 'name')->label("Логин");
            echo $form->field($login, 'password')->passwordInput()->label("Пароль");
            echo Html::submitButton("Авторизация",['class'=>"btn btn-defaul"]);
            ActiveForm::end();
        ?>
        </div>
        <div class="col-md-6"></div>
    </div>
</div>