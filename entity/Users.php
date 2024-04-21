<?php

namespace app\entity;
use app\repository\UserRepository;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Users extends ActiveRecord implements IdentityInterface
{
    public function getMyBooks()
    {
        return $this->hasMany(\app\entity\TakeBook::class, ['client_id' => 'id']);
    }

    public static function findIdentity($id)
    {
        return UserRepository::getUserById($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function validatePassword($password)
    {
        return password_verify($password, $this->password);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

    public function getAuthKey()
    {
    }

    public function validateAuthKey($authKey)
    {
    }
}