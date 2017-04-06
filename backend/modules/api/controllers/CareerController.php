<?php

namespace backend\modules\api\controllers;

use yii;
use backend\modules\api\models\Career;

class CareerController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreateCareer() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // Para Json types resquest
        $requests                    = \Yii::$app->request->post();

        $valid = 0;

        foreach ($requests as $key => $request) {
            $career              = new Career();
            $career->scenario    = Career::SCENARIO_CREATE;
            $career->code        = $request['code'];
            $career->name        = $request['name'];
            if($career->validate()){
                if($career->save()){
                    $valid = 1;
                }
            }
            else {
                return array('status'=>false,'data'=>$career->getErrors());
            }
        }
        if($valid)
            return array('status'=>true,'data'=>'Career created successfully.');

    }

    public function actionListCareer() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // Para Json types resquest
        $career = Career::find()->all();
        if(count($career)>0) {
            return array('status'=>true,'data'=>$career);
        } else {
            return array('status'=>false,'data'=>'Not Careeries found.');
        }
    }

    /* STRUCTURE DATA JSON SEND FROM FRONTEND
    [
      {
        "code": STRING,
        "name": STRING
      }
    ]
    */

}
