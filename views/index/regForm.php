<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
?>
<div class="container">
    <h1>Регистрация</h1>
    <div class="row">
        <div class="col-md-6">
            <?=isset($testReg)?'<p style="color:green;">'.$testReg.'</p>':''?>
            <?php
            if(isset($errorMessage) && count($errorMessage)){
            ?>
            <p style="color:red;">Ошибки:
                <ul style="color:red;">
                <?php 
                foreach($errorMessage as $error)
                    echo '<li>'.$error.'</li>';
                ?>
                </ul>
            </p>
            <?php
            }
            ?>
        <?php
            $form = ActiveForm::begin();

            echo $form->field($regForm, 'name')->label("Логин");
            echo $form->field($regForm, 'email')->label("E-mail");
            echo $form->field($regForm, 'phone')->label("Телефон");
            echo $form->field($regForm, 'password')->passwordInput()->label("Пароль");
            echo $form->field($regForm, 'password_repeat')->passwordInput()->label("Повторный пароль");
            echo $form->field($regForm, 'captcha')->widget(Captcha::className())->label("Капча");
            echo Html::submitButton("Регистрация",['class'=>"btn btn-defaul"]);
            ActiveForm::end();
        ?>
        </div>
        <div class="col-md-6"></div>
    </div>
</div>