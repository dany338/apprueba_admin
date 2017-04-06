<?php

namespace backend\modules\api\controllers;

use yii;
use backend\modules\api\models\Statement;

class StatementController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreateStatement() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // Para Json types resquest
        $statement = new Statement();
        $statement->scenario      = Statement::SCENARIO_CREATE;
        $statement->attributes    = \Yii::$app->request->post();

        if($statement->validate()){
            $statement->load(Yii::$app->request->post());
            $statement->save();
            return array('status'=>true,'data'=>'Statement created successfully.');
        } else {
            return array('status'=>false,'data'=>$statement->getErrors());
        }
    }

    public function actionListStatement() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // Para Json types resquest
        $statement = Statement::find()->all();
        if(count($statement)>0) {
            return array('status'=>true,'data'=>$statement);
        } else {
            return array('status'=>false,'data'=>'Not statements found.');
        }
    }

}
