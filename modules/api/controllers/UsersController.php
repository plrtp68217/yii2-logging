<?php

namespace app\modules\api\controllers;

use Yii;
use app\modules\api\controllers\RestController;
use app\models\Category;
use yii\web\MethodNotAllowedHttpException;


class  UsersController extends RestController 
{   

    public $modelClass = 'app\models\Category';

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

        $model = Category::find()->all();

        return 
        [
            'success' => true,
            'data' => $model,
        ];
    }

    public function actionView($id) 
    {       
        if (!Yii::$app->request->isGet && !Yii::$app->request->isHead) 
        {
            throw new MethodNotAllowedHttpException('USE [GET, HEAD]');
        }

        $model = Category::find()->where(['id' => $id])->one();

        if ($model) 
        {
            return 
            [
                'success' => true,
                'data' => $model,
            ];
        }

        return 
        [
            'success' => false,
            'data' => 'not found',
        ];

    } 

    public function actionCreate() 
    {   
        if (!Yii::$app->request->isPost) 
        {
            throw new MethodNotAllowedHttpException('USE [POST]');
        }

        $model = new Category();
        $model->load(Yii::$app->request->post(), '');

        if ($model->validate()) 
        {   
            $category = Category::findOne(['title' => $model->title]); 
            if ($category){
                
                $category->alias = $model->alias;
                $category->save();
                Yii::$app->response->setStatusCode(200);

                return 
                [
                    'status' => 'success',
                    'message' => 'Updated succesfully',
                    'data' =>$category,
                ];
            }

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

    // public function actionUpdate($title) 
    // {   
    //     if (!Yii::$app->request->isPut && !Yii::$app->request->isPatch) 
    //     {
    //         throw new MethodNotAllowedHttpException('USE [PUT, PATCH]');
    //     }

    //     $model = Category::findOne(['title' => $title]);

    //     if ($model->load(Yii::$app->request->getBodyParams()) && $model->save()) 
    //     {
    //         Yii::$app->response->setStatusCode(200);

    //         return 
    //         [
    //             'status' => 'success',
    //             'message' => 'Updated succesfully',
    //             'data' => $model,
    //         ];
    //     }
    // }
}