<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\RegistrationForm $model */
/** @var ActiveForm $form */

$this->title = 'Добавить сотрудника';
?>
<div class="site-topic">
    <h1 class="h1-log-topic"><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>
    <div class="div-log-topic">

        <?= $form->field($model, 'surname') ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'patronymic') ?>
        <?= $form->field($model, 'post') ?>
    </div>
    <div class="form-group-topic">
        <?= Html::submitButton('Добавить сотрудника', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>