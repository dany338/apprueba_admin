<?php

namespace backend\modules\api\controllers;

use yii;
use backend\modules\api\models\Category;

class CategoryController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreateCategory() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // Para Json types resquest
        $category = new Category();
        $category->scenario      = Category::SCENARIO_CREATE;
        $category->attributes    = \Yii::$app->request->post();

        if($category->validate()){
            $category->load(Yii::$app->request->post());
            $category->save();
            return array('status'=>true,'data'=>'Category created successfully.');
        } else {
            return array('status'=>false,'data'=>$category->getErrors());
        }
    }

    public function actionListCategory() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // Para Json types resquest
        $category = Category::find()->all();
        if(count($category)>0) {
            return array('status'=>true,'data'=>$category);
        } else {
            return array('status'=>false,'data'=>'Not categories found.');
        }
    }

}
