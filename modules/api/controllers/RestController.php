<?php

namespace app\modules\api\controllers;

use Yii;
use yii\rest\ActiveController;

class RestController extends ActiveController 
{
    public function beforeAction($action) 
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
}