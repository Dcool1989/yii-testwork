<?php

/** @var yii\web\View $this */

/** @var $clients $this */

use yii\helpers\Html;


?>
<div class="list-client">


    <div class="client">
        <?php foreach ($clients as $client): ?>

            <div class="list-client-name">
                <a href="../site/this-client?client_id=<?=$client['id']?>"><h2 class="h2-forum"><?=$client['name']?></h2></a>
                <p><?= $client['haveBook']?'есть книги':'нет книг'?></p>
            </div>

        <?php endforeach; ?>

    </div>
    <div class="list-add-client">
        <a href="/site/create-client">Добавить клиента</a>
    </div>
</div>
