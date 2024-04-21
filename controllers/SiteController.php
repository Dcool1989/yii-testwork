<?php

namespace app\controllers;

use app\entity\TakeBook;
use app\entity\Users;
use app\models\BookForm;
use app\models\ClientForm;
use app\models\ModelForm;
use app\models\ReBookForm;
use app\models\RegistrationForm;
use app\models\StaffForm;
use app\models\TakeBookForm;
use app\repository\BookRepository;
use app\repository\ClientRepository;
use app\repository\ModelRepository;
use app\repository\NewsRepository;
use app\repository\StaffRepository;
use app\repository\UserRepository;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use yii\web\UploadedFile;


class SiteController extends Controller
{


    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $books = BookRepository::getBooks();
        return $this->render('index', [
            'books' => $books,

        ]);
    }


    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }


    public function actionRegistration()
    {
        $model = new RegistrationForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $userId = UserRepository::createUser(
                $model->email,
                $model->password,
                $model->name,
            );
            if ($userId) {
                Yii::$app->user->login(Users::findIdentity($userId));
                return $this->goHome();
            }
        }
        return $this->render('registration', [
            'model' => $model
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    public function actionBook($search = null, $available = false)
    {
        if(empty($search)){
            $books = BookRepository::getBooks();
        } else {
            $books = BookRepository::getBooks(['ilike','title',$search]);
        }
        $booklist = [];
        if ($available == 'true') {
            foreach ($books as $book) {
                if (is_null($book->nowTake)) {
                    $booklist [] = $book;
                }
            }
        } else {
            $booklist = $books;
        }
        return $this->render('listbook', ['books' => $booklist]);
    }

    public function actionMyBook()
    {
        $myBooks = (Yii::$app->user->identity->myBooks);
        $Books = [];
        foreach ($myBooks as $book) {
            if (is_null($book->re_date)) {
                $Books [] = $book->book;
            }
        }
        return $this->render('mybook', ['books' => $Books]);
    }

    public function actionThisBook(int $book_id)
    {
        $book = BookRepository::getBookById($book_id);
        return $this->render('thisbook', ['book' => $book]);
    }

    public function actionClient()
    {
        $clients = UserRepository::getUsers();
        $Users = [];
        foreach ($clients as $index => $client) {
            $Users[$index]=[

                'name' => $client->name,
                'id' => $client->id,
                'haveBook'=> false,
            ];
            foreach ($client->myBooks as $book) {
                if (is_null($book->re_date)) {
                    $Users[$index]['haveBook']=true;
                }
            }
        }
        return $this->render('listclient', ['clients' => $Users]);
    }

    public function actionThisClient(int $client_id)
    {
        $client = ClientRepository::getClientById($client_id);
        return $this->render('thisclient', ['client' => $client]);
    }

    public function actionStaff()
    {
        $staffs = StaffRepository::getStaffs();
        return $this->render('liststaff', ['staffs' => $staffs]);
    }

    public function actionThisStaff(int $staff_id)
    {
        $staff = StaffRepository::getStaffById($staff_id);
        return $this->render('thisstaff', ['staff' => $staff]);
    }

    public function actionCreateBook()
    {
        $model = new BookForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->validate()) {
                $model_id = BookRepository::createBook($model->title, $model->article, $model->author, $model->date);
                if (!is_dir('../storage')) {
                    mkdir('../storage');
                }
                $model->file->saveAs('../storage/' . $model_id . '.' . $model->file->extension);
                return $this->redirect('/site/book');
            }
        }
        return $this->render('book', ['model' => $model]);
    }

    public function actionTakeBook($book_id)
    {
        $model = new TakeBookForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model_id = BookRepository::TakeBook(Yii::$app->user->id, $book_id, $model->staff_id, $model->countbook);

                return $this->redirect('/site/book');
            }
        }
        $staffs = StaffRepository::getStaffs();
        $stafflist = [];
        foreach ($staffs as $staff) {
            $stafflist [$staff->id] = implode(' ', [
                $staff->surname,
                $staff->name,
                $staff->patronymic,
            ]);
        }
        return $this->render('takebook', ['model' => $model, 'staff' => $stafflist]);
    }

    public function actionReBook($book_id)
    {
        $model = new ReBookForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                BookRepository::reBook($book_id, $model->staff_id, Yii::$app->user->id, $model->condition_id);

                return $this->redirect('/site/book');
            }
        }
        $staffs = StaffRepository::getStaffs();
        $stafflist = [];
        foreach ($staffs as $staff) {
            $stafflist [$staff->id] = implode(' ', [
                $staff->surname,
                $staff->name,
                $staff->patronymic,
            ]);
        }
        $conditions = BookRepository::getConditions();
        $conditionslist = [];
        foreach ($conditions as $condition) {
            $conditionslist [$condition->id] = $condition->name;
        }
        return $this->render('rebook', ['model' => $model, 'staff' => $stafflist, 'condition' => $conditionslist]);
    }

    public function actionImage($model_id = 'default')
    {
        Yii::$app->response->sendFile("../storage/{$model_id}.jpg", null, ['inline' => true, 'mimeType' => mime_content_type("../storage/{$model_id}.jpg")]);
    }

    public function actionCreateStaff()
    {
        $model = new StaffForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            StaffRepository::createStaff($model->surname, $model->name, $model->patronymic, $model->post);
            return $this->redirect('/site/staff');
        }
        return $this->render('staff', ['model' => $model]);
    }

    public function actionCreateClient()
    {
        $model = new ClientForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            ClientRepository::createClient($model->surname, $model->name, $model->patronymic, $model->passport_series, $model->passport_number);
            return $this->redirect('/site/client');
        }
        return $this->render('client', ['model' => $model]);
    }
}



