<?php

namespace app\models;

use app\repository\UserRepository;

class ClientForm extends \yii\base\Model
{
    public $surname;
    public $name;
    public $patronymic;
    public $passport_series;
    public $passport_number;




    public function rules()
    {
        return [
            [['surname','name','patronymic'], 'required'],
            [['passport_series','passport_number'], 'integer'],
        ];
    }
}