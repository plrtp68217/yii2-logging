<?php
use yii\helpers\Html;
?>

<h1>show action</h1>
<ul>
<?php foreach ($model as $i): ?>
    <li><?= Html::encode("{$i->title} - {$i->alias}")?></li>
<?php endforeach?>
</ul>