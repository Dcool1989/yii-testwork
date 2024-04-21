<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\RegistrationForm $model */
/** @var ActiveForm $form */

$this->title = 'Добавить книгу';
?>
<div class="site-topic">
    <h1 class="h1-log-topic"><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title') ?>
    <?= $form->field($model, 'article') ?>
    <?= $form->field($model, 'author') ?>
    <?= $form->field($model, 'date')->input('date') ?>
    <?= $form->field($model, 'file')->fileInput(['value' => \yii\web\UploadedFile::getInstance($model, 'file')]) ?>

    <div class="form-group-topic">
        <?= Html::submitButton('Добавить книгу', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>