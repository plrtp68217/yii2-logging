<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title') ?>
    <?= $form->field($model, 'alias') ?>
    <?= Html::submitButton('Отправить')?>

<?php ActiveForm::end(); ?>