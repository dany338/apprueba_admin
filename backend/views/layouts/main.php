<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
rmrevin\yii\fontawesome\AssetBundle::register($this);
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Url;

AppAsset::register($this);
Yii::setAlias('@enunciados', 'http://coreceinfes.com/apprueba/#/login');
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
    <link href="//fonts.googleapis.com/css?family=Roboto:400,300,700" rel="stylesheet" type="text/css">
</head>
<body style="font-family: 'Roboto', sans-serif; font-weight: normal; background: #fafafa;">
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'API - Enunciados',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Inicio', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/user/security/login']];
    } else {
        $menuItems[] = ['label' => 'Roles', 'url' => ['/rbac']];
        $menuItems[] = ['label' => 'Perfil', 'url' => ['/user/settings/profile']];
        $menuItems[] = '<li>'
            . Html::beginForm(['/user/security/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'itemTemplate' => "<li><b>".FA::icon('cart-plus')." <i>{link}</i></b></li>\n", // template for all links
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Enunciados <?= date('Y') ?> - ENUNCIADOS - <a target="_blank" class="" href="<?=Url::to('@enunciados', true)?>" title="enunciados" align="center"><?= Html::img('@web/images/aplicación-de-logo-vertical.png', ['alt' => 'enunciados', 'width'=>'25','height'=>'25']) ?></a></p>

        <p class="pull-right"><?= 'Daniel Gallo - dany338@gmail.com '.Yii::powered() ?></p>
    </div>
</footer>   

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
