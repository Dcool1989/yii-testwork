<?php

namespace app\entity;

class TakeBook extends \yii\db\ActiveRecord
{
    public function getBook()
    {
        return $this->hasOne(\app\entity\Book::class, ['id' => 'book_id']);
    }

    public function getClient()
    {
        return $this->hasOne(\app\entity\Users::class, ['id' => 'client_id']);
    }
}