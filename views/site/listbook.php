<?php

/** @var yii\web\View $this */

/** @var $books $this */

use yii\helpers\Html;


?>
<div class="list-book">

    <div class="list-book-form">
        <form method="get">
            <input type="text" name="search">
            <input type="submit">
        </form>
    </div>

    <?php foreach ($books as $book): ?>

        <div class="list-book-title">
            <a href="../site/this-book?book_id=<?=$book->id?>"><h2 class="h2-forum"><?= $book->title?></h2></a>
        </div>

    <?php endforeach; ?>


    <div class="list-book-all">

        <a href="/site/book?available=true">В наличии</a>
        <a href="/site/book">Все</a>

    </div>

    <div class="list-add-book">
        <a href="/site/create-book">Добавить книгу</a>
    </div>

</div>
