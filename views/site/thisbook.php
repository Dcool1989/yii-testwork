<?php

/** @var $book */

?>
<div class="local-model">
    <div class="local">


        <div class="local-book">
            <img class="img" src="../site/image?model_id=<?= $book->id ?>" alt=""/>
        </div>

        <div class="local-book-title">

            <h2 class="h2-local"><?= $book->title ?></h2>
            <h3 class="h3-local"><?= $book->article ?></h3>
            <h3 class="h3-local"><?= $book->author ?></h3>
            <h3 class="h3-local"><?= date('d.m.Y', strtotime($book->date)) ?></h3>

        </div>

    </div>

    <div class="take-book">
        <?php if ($book->nowTake->client->id == Yii::$app->user->id): ?>
            <a href="/site/re-book?book_id=<?= $book->id ?>">Вернуть книгу</a>
        <?php else: ?>
            <a href="/site/take-book?book_id=<?= $book->id ?>">Взять книгу</a>
        <?php endif; ?>
    </div>

</div>
