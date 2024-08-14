<?php

namespace app\controllers;

use Yii;
use app\models\Category;

class PostController extends AppController {

    //применение шаблона для всего контроллера
    public $layout = 'basic';

    // вывод всех
    public function actionIndex() {
        //применение шаблона для конкретногоо action
        //$this->layout = 'basic'; 
        return $this->render('test');
    }

    // вывод вывод конкретной
    public function actionShow() {
        $model = Category::find()->all();

        return $this->render('show', ['model' => $model]);
    }

    
}