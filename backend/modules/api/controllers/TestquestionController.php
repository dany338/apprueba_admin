<?php

namespace backend\modules\api\controllers;

use yii;
use backend\modules\api\models\Testquestion;

class TestquestionController extends \yii\web\Controller
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
            $testquestion            = new Testquestion();
            $testquestion->scenario  = Testquestion::SCENARIO_CREATE;
            $testquestion->idTest    = $request['idTest'];
            $testquestion->idQuestion= $request['idQuestion'];
            if($testquestion->validate()){
                if($testquestion->save()){
                    $valid = 1;
                }
            }
            else {
                return array('status'=>false,'data'=>$testquestion->getErrors());
            }
        }
        if($valid)
            return array('status'=>true,'data'=>'Testquestion created successfully.');

    }

    public function actionListTestquestion() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // Para Json types resquest
        $testquestion = Testquestion::find()->all();
        if(count($testquestion)>0) {
            return array('status'=>true,'data'=>$testquestion);
        } else {
            return array('status'=>false,'data'=>'Not testquestion found.');
        }
    }

    /* STRUCTURE DATA JSON SEND FROM FRONTEND
    [
      {
        "id": INTEGER,
        "idTest": STRING,
        "idQuestion": INTEGER
      }
    ]
    */

}
