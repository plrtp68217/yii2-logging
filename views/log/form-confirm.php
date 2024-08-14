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
    <h1>Данные таблицы Categories</h1>
    <div>
        <ul>
            <?php foreach ($model as $model_item):?>
            <li>
                <?=Html::encode("{$model_item->title} - {$model_item->alias}")?>
            </li>
            <?php endforeach?>

        </ul>
    </div>
    <a href="<?= Url::to(['log/logger'])?>">Таблица логирования</a><br>
    <a href="<?= Url::to(['log/form'])?>">Назад к форме</a>
</body>
</html>