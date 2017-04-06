<?php

namespace backend\modules\api\controllers;

class PictureController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
