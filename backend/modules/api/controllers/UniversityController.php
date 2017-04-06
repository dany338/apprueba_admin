<?php

namespace backend\modules\api\controllers;

use yii;
use backend\modules\api\models\University;

class UniversityController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreateUniversity() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // Para Json types resquest
        $requests                    = \Yii::$app->request->post();

        $valid = 0;

        foreach ($requests as $key => $request) {
            $university              = new University();
            $university->scenario    = University::SCENARIO_CREATE;
            $university->code        = $request['code'];
            $university->name        = $request['name'];
            if($university->validate()){
                if($university->save()){
                    $valid = 1;
                }
            }
            else {
                return array('status'=>false,'data'=>$university->getErrors());
            }
        }
        if($valid)
            return array('status'=>true,'data'=>'State created successfully.');

    }

    public function actionListUniversity() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // Para Json types resquest
        $university = University::find()->all();
        if(count($university)>0) {
            return array('status'=>true,'data'=>$university);
        } else {
            return array('status'=>false,'data'=>'Not Universities found.');
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
