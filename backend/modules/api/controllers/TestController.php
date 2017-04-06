<?php

namespace backend\modules\api\controllers;

use yii;
use backend\modules\api\models\Test;

class TestController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreateTestquestion() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // Para Json types resquest
        $requests                    = \Yii::$app->request->post();

        $valid = 0;

        foreach ($requests as $key => $request) {
            $test          = new Test();
            $test->scenario= Test::SCENARIO_CREATE;
            $test->code    = $request['code'];
            $test->name    = $request['name'];
            if($test->validate()){
                if($test->save()){
                    $valid = 1;
                }
            }
            else {
                return array('status'=>false,'data'=>$test->getErrors());
            }
        }
        if($valid)
            return array('status'=>true,'data'=>'Test created successfully.');

    }

    public function actionListTest() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // Para Json types resquest
        $test = Test::find()->all();
        if(count($test)>0) {
            return array('status'=>true,'data'=>$test);
        } else {
            return array('status'=>false,'data'=>'Not Test found.');
        }
    }

    /* STRUCTURE DATA JSON SEND FROM FRONTEND
    [
      {
        "id": INTEGER,
        "code": STRING,
        "name": STRING
      }
    ]
    */
}
