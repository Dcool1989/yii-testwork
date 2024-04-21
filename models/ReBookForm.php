<?php

namespace app\models;

use app\repository\UserRepository;

class ReBookForm extends \yii\base\Model
{
    public $staff_id;
    public $condition_id;



    public function rules()
    {
        return [
            [['staff_id','condition_id'], 'required'],
        ];
    }
}