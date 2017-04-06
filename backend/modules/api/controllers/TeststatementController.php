<?php

namespace backend\modules\api\controllers;

use yii;
use backend\modules\api\models\Teststatement;

class TeststatementController extends \yii\web\Controller
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
            $teststatement              = new Teststatement();
            $teststatement->scenario    = Teststatement::SCENARIO_CREATE;
            $teststatement->idTest      = $request['idTest'];
            $teststatement->idStatement = $request['idStatement'];
            if($teststatement->validate()){
                if($teststatement->save()){
                    $valid = 1;
                }
            }
            else {
                return array('status'=>false,'data'=>$teststatement->getErrors());
            }
        }
        if($valid)
            return array('status'=>true,'data'=>'Teststatement created successfully.');

    }

    public function actionListTest() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // Para Json types resquest
        $teststatement = Teststatement::find()->all();
        if(count($teststatement)>0) {
            return array('status'=>true,'data'=>$teststatement);
        } else {
            return array('status'=>false,'data'=>'Not Teststatement found.');
        }
    }

    /* STRUCTURE DATA JSON SEND FROM FRONTEND
    [
      {
        "id": INTEGER,
        "idTest": INTEGER,
        "idStatement": INTEGER
      }
    ]
    */

}
