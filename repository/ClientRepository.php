<?php

namespace app\repository;
use app\entity\Client;


class ClientRepository
{
    public static function getClients()
    {
        return Client::find()->all();
    }



    public static function createClient($surname, $name, $patronymic, $passport_series, $passport_number)
    {
        $client = new Client();
        $client->surname=$surname;
        $client->name=$name;
        $client->patronymic=$patronymic;
        $client->passport_series=$passport_series;
        $client->passport_number=$passport_number;
        $client->save();
        return $client->id;
    }

    public static function getClientById($client_id) {
        return Client::find()->where(['id'=>$client_id])->one();
    }


}