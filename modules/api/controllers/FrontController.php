<?php

namespace app\modules\api\controllers;

use Yii;
use app\modules\api\controllers\RestController;
use app\models\LoggingFront;
use yii\web\MethodNotAllowedHttpException;


class  FrontController extends RestController 
{   

    public $modelClass = 'app\models\Category';

    protected function getMacAddressWindows() {
        $output = shell_exec('getmac');
        $lines = explode("\n", $output);
        foreach ($lines as $line) {
            if (preg_match('/^([0-9A-Fa-f]{2}-[0-9A-Fa-f]{2}-[0-9A-Fa-f]{2}-[0-9A-Fa-f]{2}-[0-9A-Fa-f]{2}-[0-9A-Fa-f]{2})/', $line, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    protected function getMacAddressLinux() {
        $output = shell_exec('/sbin/ifconfig');
        if (preg_match_all('/ether\s+([0-9A-Fa-f:]{17})/', $output, $matches)) {
            return $matches[1][0];
        }
        return null;
    }
    

    function getMacAddress() {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            return $this->getMacAddressWindows();
        } elseif (PHP_OS === 'Linux') {
            return $this->getMacAddressLinux();
        } else {
            return null;
        }
    }


    public function actions() 
    {   
        return array_merge(parent::actions(),
        [
            'create' => null,
            'view' => null,
            'update' => null,
            'delete' => null,
            'index' => null,
            'put' => null,
            'patch' => null,
        ]);
    }


    public function actionIndex() 
    {
        if (!Yii::$app->request->isGet && !Yii::$app->request->isHead) 
        {
            throw new MethodNotAllowedHttpException('USE [GET, HEAD]');
        }

        $model = LoggingFront::find()->all();

        return 
        [
            'success' => true,
            'data' => $model,
        ];
    }

    public function actionCreate() 
    {   
        if (!Yii::$app->request->isPost) 
        {
            throw new MethodNotAllowedHttpException('USE [POST]');
        }

        $model = new LoggingFront();

        $frontData = Yii::$app->request->post(); // данные, полученные от клиента

        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $macAddress = $this->getMacAddress();

        $userName = get_current_user();

        date_default_timezone_set('Europe/Moscow');
        $dateDb = date('Y-m-d H:i:s');

        $backendData = [
            'user_name' => $userName,
            'mac_address' => $macAddress,
            'ip_address' => $ipAddress,
            'date_db' => $dateDb
        ];

        $data = array_merge($backendData, $frontData);

        $model->load($data, '');

        if ($model->validate()) 
        {
            $model->save();
            Yii::$app->response->setStatusCode(201);
            return 
            [
                'status' => 'success',
                'message' => 'Created succesfully',
                'data' =>$model,
            ];
        }
        
        Yii::$app->response->setStatusCode(403);
        return 
            [
                'status' => 'error',
                'message' => 'Validation failed by create',
                'errors' => $model->getErrors(),
            ];
    }
}