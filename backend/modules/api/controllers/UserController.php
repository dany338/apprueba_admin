<?php

namespace backend\modules\api\controllers;

use yii;
use backend\modules\api\models\User;
use backend\modules\api\models\Profile;
use backend\modules\api\models\Test;
use backend\modules\api\models\Question;

class UserController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
    const TYPE_STUDENT = 3;
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreateUser() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // Para Json types resquest
        $requests                    = \Yii::$app->request->post();

        $valid = 0;

        $user                = new user();
        $user->scenario      = user::SCENARIO_CREATE;
        $user->username      = explode('@', $requests['email'])[0];
        $user->email         = $requests['email'];
        $user->password_hash = Yii::$app->security->generatePasswordHash($requests['password_hash'], Yii::$app->getModule('user')->cost);
        $user->confirmed_at  = time();
        $user->updated_at    = time();
        $user->flags         = 0b10;
        $user->auth_key      = \Yii::$app->security->generateRandomString();
        $testCount                   = Test::find()->where(['code'=>$requests['code']])->count();
        if($testCount == 1)
            $test                    = Test::find()->where(['code'=>$requests['code']])->one();

        if($user->validate()){
            if($user->save()){
                $profile                 = new Profile();
                $profile->user_id        = $user->id;
                $profile->name           = $requests['fullName'];
                $profile->public_email   = $requests['email'];
                $profile->gravatar_email = $requests['email'];
                $profile->location       = 'Colombia';
                $profile->timezone       = 'America/Bogota';
                $profile->idTipo         = User::TYPE_STUDENT; // Is Student
                $profile->idCareer       = $requests['idCareer'];
                $profile->idUniversity   = $requests['idUniversity'];
                $profile->age            = $requests['age'];
                $profile->nombres        = $requests['fullName'];
                $profile->apellidos      = $requests['fullName'];
                if($profile->validate()){
                    if($profile->save()){
                        $valid = 1;
                    }
                }
                else {
                    return array('status'=>false,'data'=>$profile->getErrors());
                }
            }
        }
        else {
            return array('status'=>false,'data'=>$user->getErrors());
        }

        if($valid)
        {
            $arrtestquestion = array();
            foreach ($test->testquestions as $key => $testquestion) {
                $arrtestquestion[] = array(
                    'id'         => $testquestion->id,
                    'idTest'     => $testquestion->idTest,
                    'idQuestion' => $testquestion->idQuestion,
                    'test'       => $testquestion->idTest0->name,
                    'question'   => $testquestion->idQuestion0->name
                );
            }
            $arrteststatements = array();
            foreach ($test->teststatements as $key => $teststatement) {
                $arrteststatements[] = array(
                    'id'         => $teststatement->id,
                    'idTest'     => $teststatement->idTest,
                    'idStatement'=> $teststatement->idStatement,
                    'test'       => $teststatement->idTest0->name,
                    'statement'  => $teststatement->idStatement0->description
                );
            }
            return array(
                'status'   => true,
                'data'     => $user,
                'auth_key' => $user->auth_key,
                'test'     => array(
                                'test'=>$test,
                                'testquestion' => $arrtestquestion,
                                'teststatement'=> $arrteststatements
                              )
            );
        }
        else {
            return array('status'=>false,'data'=>'User and profile not created.');
        }
    }

    public function actionListUser() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // Para Json types resquest
        $user = User::find()->all();
        if(count($user)>0) {
            return array('status'=>true,'data'=>$user);
        } else {
            return array('status'=>false,'data'=>'Not users found.');
        }
    }

    public function actionLoginUser() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // Para Json types resquest
        $requests                    = Yii::$app->request->post();
        $email                       = $requests['email'];
        $password                    = $requests['password_hash'];
        $code                        = $requests['code'];
        $user                        = User::find()->where(['email'=>$email])->one();
        $testCount                   = Test::find()->where(['code'=>$code])->count();
        if($testCount == 1)
            $test                    = Test::find()->where(['code'=>$code])->one();

        if(Yii::$app->security->validatePassword($password, $user->password_hash)) {
            $arrtestquestion = array();
            foreach ($test->testquestions as $key => $testquestion) {
                $arrtestquestion[] = array(
                    'id'         => $testquestion->id,
                    'idTest'     => $testquestion->idTest,
                    'idQuestion' => $testquestion->idQuestion,
                    'test'       => $testquestion->idTest0->name,
                    'question'   => $testquestion->idQuestion0->name
                );
            }
            $arrteststatements = array();
            foreach ($test->teststatements as $key => $teststatement) {
                $arrteststatements[] = array(
                    'id'         => $teststatement->id,
                    'idTest'     => $teststatement->idTest,
                    'idStatement'=> $teststatement->idStatement,
                    'test'       => $teststatement->idTest0->name,
                    'statement'  => $teststatement->idStatement0->description
                );
            }
            return array(
                'status'   => true,
                'data'     => $user,
                'auth_key' => $user->auth_key,
                'test'     => array(
                                'test'=>$test,
                                'testquestion' => $arrtestquestion,
                                'teststatement'=> $arrteststatements
                              )
            );
        }
        else {
            return array('status'=>false,'data'=>'Invalid login or password');
        }
    }

    /* STRUCTURE DATA JSON SEND FROM FRONTEND
    login
    {
      "email": STRING,
      "password_hash": STRING,
      "code": STRING
    }

    create
    {
      "fullName": STRING,
      "age": INTEGER,
      "email": STRING,
      "idCareer": INTEGER,
      "idUniversity": INTEGER,
      "password_hash": STRING,
      "code": STRING
    }
    */
}
