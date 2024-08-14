<?php

namespace app\models;

use yii\db\ActiveRecord;

class LoggingFront extends ActiveRecord {
    public static function tableName() 
    {
        return 'logging_front';
    }

    public function rules()
    {
        return 
        [
            [['user_name', 'mac_address', 'ip_address', 'event', 'date_ui', 'date_db' ], 'required'],
        ];
    }
}