<?php

namespace app\entity;

class Book extends \yii\db\ActiveRecord
{
    public function getClient()
    {
        return $this->hasOne(\app\entity\Users::class, ['id' => 'client_id'])
            ->viaTable(TakeBook::tableName(),['book_id'=>'id']);
    }

    public function getNowTake()
    {
        return $this->hasOne(TakeBook::class,['book_id'=>'id'])
            ->where(['re_date'=>null]);
    }

}