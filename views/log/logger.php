<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Данные таблицы Logging Table</h1>
    <div>
        <ul>
            <?php foreach ($model as $model_item):?>
            <li>
                <?=Html::encode("{$model_item->table_name} - {$model_item->date} - {$model_item->event}")?>
            </li>
            <?php endforeach?>
        </ul>
    </div>
    <a href="<?= Url::to(['log/form'])?>">Назад</a>
</body>
</html>