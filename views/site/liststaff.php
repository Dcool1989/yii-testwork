<?php

/** @var yii\web\View $this */

/** @var $staffs $this */

use yii\helpers\Html;


?>
<div class="list-staff">

    <div class="list-staff-title">

        <h2> Список сотрудников:</h2>

    </div>

    <div class="staff">
        <?php foreach ($staffs as $staff): ?>

            <div class="list-staff-name">
                <a href="../site/this-staff?staff_id=<?=$staff->id?>"><h2 class="h2-forum"><?=$staff->surname .' '. $staff->name .' '. $staff->patronymic?></h2></a>
            </div>

        <?php endforeach; ?>

    </div>
    <div class="list-add-staff">
        <a href="/site/create-staff">Добавить сотрудника</a>
    </div>
</div>
