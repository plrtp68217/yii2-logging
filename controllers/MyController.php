<?php

namespace app\controllers;

use yii\web\Controller;

class MyController extends Controller {
    public function actionIndex($id = null) {
        $hi = 'hello world, index.php' . '<br>';
        $names = ['bony', 'claid', 'joe'];
        return $this->render('index', ['hello' => $hi, 'names' => $names, 'id' => $id]);
    }
}