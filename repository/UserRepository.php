<?php

namespace app\repository;
use app\entity\Users;

class UserRepository
{

    public static function getUserByEmail($email)
    {
        return Users::find()->where(['email'=>$email])->one();
    }

    public static function getUsers()
    {
        return Users::find()->all();
    }


    public static function createUser($email, $password, $name)
    {
        $user = new Users();
        $user->email = $email;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->name = $name;
        $user->save();
        return $user->id;
    }

    public static function getUserById($user_id)
    {
        return Users::find()->where(['id'=>$user_id])->one();
    }
}