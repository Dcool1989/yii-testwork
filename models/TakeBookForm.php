<?php

namespace app\models;

use app\repository\UserRepository;

class TakeBookForm extends \yii\base\Model
{
    public $staff_id;
    public $countbook;



    public function rules()
    {
        return [
            [['staff_id','countbook'], 'required'],
        ];
    }
}