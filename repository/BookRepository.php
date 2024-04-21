<?php

namespace app\repository;
use app\entity\Book;
use app\entity\DirCondition;
use app\entity\TakeBook;


class BookRepository
{
    public static function getBooks($where=[])
    {
        return Book::find()->where($where)->all();
    }



    public static function createBook($title, $article, $author, $date)
    {
        $book = new Book();
        $book->title=$title;
        $book->article=$article;
        $book->author=$author;
        $book->date=$date;
        $book->save();
        return $book->id;
    }

    public static function takeBook($client_id,$book_id,$staff_id,$countBook,$date=null)
    {
        if (is_null($date)) {
            $date=date('Y-m-d H:i:s');
        }
            $takeBook = new TakeBook();
            $takeBook->client_id = $client_id;
            $takeBook->book_id = $book_id;
            $takeBook->staff_id = $staff_id;
            $takeBook->countbook = $countBook;
            $takeBook->date = $date;
            $takeBook->save();
            return $takeBook->id;
    }

    public static function getBookById($book_id) {
        return Book::find()->where(['id'=>$book_id])->one();
    }

    public static function getConditions() {
        return DirCondition::find()->all();
    }

    public static function reBook($book_id, $staff_id, $client_id, $condition_id,$date=null) {
        if (is_null($date)) {
            $date=date('Y-m-d H:i:s');
        }
        $reBook = TakeBook::find()->where(['book_id'=>$book_id,'client_id'=>$client_id])->one();
        $reBook-> re_staff_id = $staff_id;
        $reBook-> re_date = $date;
        $reBook->re_condition_id = $condition_id;
        $reBook-> save();
    }

}