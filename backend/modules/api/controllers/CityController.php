<?php

namespace backend\modules\api\controllers;

use yii;
use backend\modules\api\models\City;

class CityController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreateCity() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // Para Json types resquest
        $requests                    = \Yii::$app->request->post();

        $valid = 0;

        foreach ($requests as $key => $request) {
            $city               = new City();
            $city->scenario     = City::SCENARIO_CREATE;
            $city->codeDane     = $request['codeDane'];
            $city->idState      = $request['idState'];
            $city->name         = $request['name'];
            if($city->validate()){
                if($city->save()){
                    $valid = 1;
                }
            }
            else {
                return array('status'=>false,'data'=>$city->getErrors());
            }
        }
        if($valid)
            return array('status'=>true,'data'=>'City created successfully.');

    }

    public function actionListCity() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // Para Json types resquest
        $city = City::find()->all();
        if(count($city)>0) {
            return array('status'=>true,'data'=>$city);
        } else {
            return array('status'=>false,'data'=>'Not Cities found.');
        }
    }

    /* STRUCTURE DATA JSON SEND FROM FRONTEND
    [
      {
        "codeDane": STRING,
        "idState": INTEGER,
        "name": STRING
      }
    ]
    */

}
