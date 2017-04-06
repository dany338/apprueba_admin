<?php

namespace backend\modules\api\controllers;

use yii;
use backend\modules\api\models\Configuration;

class ConfigurationController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreateConfiguration() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // Para Json types resquest
        $requests                    = \Yii::$app->request->post();

        $valid = 0;

        foreach ($requests as $key => $request) {
            $configuration              = new Configuration();
            $configuration->scenario    = Configuration::SCENARIO_CREATE;
            $configuration->idTest      = $request['idTest'];
            $configuration->type        = $request['type'];
            $configuration->count       = $request['count'];
            if($configuration->validate()){
                if($configuration->save()){
                    $valid = 1;
                }
            }
            else {
                return array('status'=>false,'data'=>$configuration->getErrors());
            }
        }
        if($valid)
            return array('status'=>true,'data'=>'Configuration created successfully.');

    }

    public function actionListConfiguration() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // Para Json types resquest
        $configuration = Configuration::find()->all();
        if(count($configuration)>0) {
            return array('status'=>true,'data'=>$configuration);
        } else {
            return array('status'=>false,'data'=>'Not Configurations found.');
        }
    }

    public function actionTestConfiguration() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // Para Json types resquest
        $params        = Yii::$app->request->queryParams;
        //$requests      = \Yii::$app->request->post();
        $configuration = Configuration::find()->where(['idTest'=>$params['idTest']])->all();
        if(count($configuration)>0) {
            return array('status'=>true,'data'=>$configuration);
        } else {
            return array('status'=>false,'data'=>'Not Configuration found.');
        }
    }

    /* STRUCTURE DATA JSON SEND FROM FRONTEND
    [
      {
        "idTest": INTEGER,
        "type": STRING, //'Code','Random'
        "count": INTEGER
      }
    ]
    */

}
