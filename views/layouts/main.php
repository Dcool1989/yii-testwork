<?php

/** @var yii\web\View $this */

/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
//\app\assets\MainAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>


<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php

    NavBar::begin([
        'brandLabel' => 'Мир книг и знаний',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class navbar' => 'navbar-expand-md navbar-white fixed-top']
    ]);

    $nav_items =  [['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'Библиотека', 'url' => ['/site/book']],
            ];


    if (Yii::$app->user->isGuest) {
        $nav_items []=['label' => 'Регистрация', 'url' => ['/site/registration']];
        $nav_items []=['label' => 'Авторизация', 'url' => ['/site/login']];

    } else {
        if (Yii::$app->user->identity->is_admin)
        {
            $nav_items []=['label' => 'Сотрудники', 'url' => ['/site/staff']];
            $nav_items []=['label' => 'Клиенты', 'url' => ['/site/client']];
        }
        $nav_name = Yii::$app->user->identity->name;
        $nav_items []=['label' => 'Мои книги', 'url' => ['/site/my-book']];
        $nav_items []= ['label' => "({$nav_name})  Выход", 'url' => ['/site/logout']];
    }

    echo Nav::widget([
        'items' => $nav_items,
        'options' => ['class' => 'navbar-nav'],
    ]);
    NavBar::end();

    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer">
    <div class="footer-text">
        Ищите нас по адресу: Санкт-Петербург, Краснопутиловская улица, д.109      тел. 533-33-00
    </div>
</footer>

<?php $this->endBody() ?>

</body>

<?php $this->endPage() ?>




