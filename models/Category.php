<?php

namespace app\models;

use yii\db\ActiveRecord;

class Category extends ActiveRecord 
{
    public static function tableName() 
    {
        return 'category';
    }

    public function rules()
    {
        return 
        [
            [['title', 'alias'], 'required'],
            // ['title', 'unique']
        ];
    }
}