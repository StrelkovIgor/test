<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\components\Users;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Тестовое задание',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $users = new Users();
    $items = [];
    if($users->is_role(1)){
        $items[] = ['label' => 'Админ Панель', 'url' => [Yii::$app->urlManager->createUrl('admin/index')]];
    }
    if($users->is_login()){
        $u = $users->get_login();
        $items[] = ['label' => $u->name];
        $items[] = ['label' => 'Выход', 'url' => [Yii::$app->urlManager->createUrl('index/loginout')]];
    }else{
        $items[] = ['label' => 'Регистрация', 'url' => [Yii::$app->urlManager->createUrl('index/reg')]];
        $items[] = ['label' => 'Вход', 'url' => [Yii::$app->urlManager->createUrl('index/login')]];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => /*[
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            $users->is_login()? (  
                ['label' => 'Выход', 'url' => [Yii::$app->urlManager->createUrl('index/loginout')]]    
                ) : (
                ['label' => 'Регистрация', 'url' => [Yii::$app->urlManager->createUrl('index/reg')]]
                    ),
            
            ['label' => 'Регистрация', 'url' => [Yii::$app->urlManager->createUrl('index/reg')]],
            Yii::$app->user->isGuest ? (
                ['label' => 'Вход', 'url' => [Yii::$app->urlManager->createUrl('index/login')]]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],*/
        $items
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
