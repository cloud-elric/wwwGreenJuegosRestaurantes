<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="apple-touch-icon" sizes="57x57" href="<?=Url::base()?>/webAssets/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?=Url::base()?>/webAssets/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?=Url::base()?>/webAssets/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?=Url::base()?>/webAssets/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?=Url::base()?>/webAssets/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?=Url::base()?>/webAssets/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?=Url::base()?>/webAssets/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?=Url::base()?>/webAssets/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=Url::base()?>/webAssets/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?=Url::base()?>/webAssets/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=Url::base()?>/webAssets/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?=Url::base()?>/webAssets/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=Url::base()?>/webAssets/favicons/favicon-16x16.png">
    <script type="text/javascript" src="<?=Url::base()?>/webAssets/js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="<?=Url::base()?>/webAssets/js/jquery.jqpuzzle.full.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=Url::base()?>/webAssets/css/jquery.jqpuzzle.css" />

    <script>
        var baseUrl = '<?=Url::base()?>';
    </script>
</head>
<body>
<?php $this->beginBody() ?>

        <?= $content ?>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
