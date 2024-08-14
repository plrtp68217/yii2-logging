<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Category;
use app\models\LoggingTable;

class LogController extends Controller {
    public function actionForm() {

        $model = new Category();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $category = Category::findOne(['title' => $model->title]);
            if ($category){
                $category->alias = $model->alias;
                $category->save();
            }
            else {
                $new_category = new Category();
                $new_category->attributes = $model->getAttributes();
                $new_category->save();
            }

            $view_model = Category::find()->all();
            return $this->render('form-confirm', ['model' => $view_model]);
        }
        else {
            return $this->render('form', ['model' => $model]);
        }
    }

    public function actionLogger() {
        $model = LoggingTable::find()->all();
        return $this->render('logger', ['model' => $model]);

    }
}