<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\RegistrationForm $model */
/** @var ActiveForm $form */

$this->title = 'Добавить клиента';
?>
<div class="site-topic">
    <h1 class="h1-log-topic"><?= Html::encode($this->title) ?></h1>
    <div class="div-log-topic">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'surname') ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'patronymic') ?>
        <?= $form->field($model, 'passport_series') ?>
        <?= $form->field($model, 'passport_number') ?>
    </div>
    <div class="form-group-topic">
        <?= Html::submitButton('Добавить клиента', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>