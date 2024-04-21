<?php

namespace app\models;

use app\repository\UserRepository;

class StaffForm extends \yii\base\Model
{
    public $surname;
    public $name;
    public $patronymic;
    public $post;




    public function rules()
    {
        return [
            [['surname','name','patronymic','post'], 'required'],
        ];
    }
}