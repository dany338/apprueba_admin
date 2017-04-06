<?php

namespace backend\modules\api\controllers;

use yii;
use backend\modules\api\models\State;

class StateController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreateState() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // Para Json types resquest
        $requests                    = \Yii::$app->request->post();

        $valid = 0;

        foreach ($requests as $key => $request) {
            $state              = new State();
            $state->scenario    = State::SCENARIO_CREATE;
            $state->codeDane    = $request['codeDane'];
            $state->idCountry   = $request['idCountry'];
            $state->name        = $request['name'];
            if($state->validate()){
                if($state->save()){
                    $valid = 1;
                }
            }
            else {
                return array('status'=>false,'data'=>$state->getErrors());
            }
        }
        if($valid)
            return array('status'=>true,'data'=>'State created successfully.');

    }

    public function actionListState() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // Para Json types resquest
        $state = State::find()->all();
        if(count($state)>0) {
            return array('status'=>true,'data'=>$state);
        } else {
            return array('status'=>false,'data'=>'Not States found.');
        }
    }

    /* STRUCTURE DATA JSON SEND FROM FRONTEND
    [
      {
        "codeDane": STRING,
        "idCountry": INTEGER,
        "name": STRING
      }
    ]
    */
}
