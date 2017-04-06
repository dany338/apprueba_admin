<?php

namespace backend\modules\api\controllers;

use yii;
use backend\modules\api\models\Question;
use backend\modules\api\models\Answeroption;

class QuestionController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreateQuestion() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // Para Json types resquest

        $requests                  = \Yii::$app->request->post();

        $valid = 0;

        foreach ($requests as $key => $request) {
            $question              = new Question();
            $question->scenario    = Question::SCENARIO_CREATE;
            $question->idStatement = $request['id_enunciado'];
            $question->code        = ''.$request['id'];
            $question->name        = $request['pregunta'];
            $question->answer      = $request['correcta'];
            if($question->validate()){
                if($question->save()){
                    foreach ($request['opciones'] as $key2 => $option) {
                        $answeroption             = new Answeroption();
                        $answeroption->idQuestion = $question->id;
                        $answeroption->name       = $option;
                        $answeroption->option     = $key2;
                        if($answeroption->validate()){
                            if($answeroption->save()){
                                $valid = 1;
                            }
                        }
                        else {
                            return array('status'=>false,'data'=>$answeroption->getErrors());
                        }
                    }

                }
            }
            else {
                return array('status'=>false,'data'=>$question->getErrors());
            }
        }
        if($valid)
            return array('status'=>true,'data'=>'Question and options created successfully.');

    }

    public function actionListQuestion() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // Para Json types resquest
        $question = Question::find()->all();
        if(count($question)>0) {
            return array('status'=>true,'data'=>$question);
        } else {
            return array('status'=>false,'data'=>'Not questions found.');
        }
    }

}
