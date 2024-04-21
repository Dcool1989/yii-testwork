<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var $staff */
/** @var $condition */
/** @var app\models\RegistrationForm $model */
/** @var ActiveForm $form */

$this->title = 'Вернуть книгу';
?>
<div class="site-topic">
    <h1 class="h1-log-topic"><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'staff_id')->dropDownList($staff) ?>
    <?= $form->field($model, 'condition_id')->dropDownList($condition) ?>


    <div class="form-group-topic">
        <?= Html::submitButton('Вернуть книгу', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>