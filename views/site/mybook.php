<?php

/** @var yii\web\View $this */
/** @var $books $this */

use yii\helpers\Html;
$user = Yii::$app->user;
?>
<div class="site-index">


    <div class="body-content">


        <div class="list">
            <?php foreach ($books as $book): ?>

                <div class="list-book-title">
                    <a href="../site/this-book?book_id=<?= $book->id ?>"><h2 class="h2-forum"><?= $book->title ?></h2>
                    </a>
                </div>

            <?php endforeach; ?>

        </div>


    </div>
</div>
