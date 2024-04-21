<?php

namespace app\models;

use app\repository\UserRepository;

class RegistrationForm extends \yii\base\Model
{
    public $name;
    public $email;
    public $password;
    public $repeatPassword;

    public function rules()
    {
        return [
            [['name', 'email', 'password', 'repeatPassword'], 'required'],
            ['email', 'email'],
            ['repeatPassword', 'compare', 'compareAttribute' => 'password'],
            ['email', 'validateEmail']
        ];
    }

    public function validateEmail($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = UserRepository::getUserByEmail($this->email);

            if ($user) {
                $this->addError($attribute, 'Пользователь уже существует');
            }
        }
    }
}