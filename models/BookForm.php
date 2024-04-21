<?php

namespace app\models;

use app\repository\UserRepository;

class BookForm extends \yii\base\Model
{
    public $title;
    public $article;
    public $author;
    public $date;
    public $file;




    public function rules()
    {
        return [
            [['title','article','author','date','file'], 'required'],
            ['author','string'],
            ['article', 'integer'],
        ];
    }
}