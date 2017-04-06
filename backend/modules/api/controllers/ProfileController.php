<?php

namespace backend\modules\api\controllers;

use yii;
use backend\modules\api\models\Profile;

class ProfileController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        return $this->render('index');
    }

}
