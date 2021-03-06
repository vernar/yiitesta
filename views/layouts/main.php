<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;
use app\models\Cart;

$cart = new Cart();
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<section class="body">
    <header>
        <div class="container">
            <div class="header">
                <a href="/">На главную</a>
                <?php if (Yii::$app->user->isGuest): ?>
                    <a href="<?=Url::to('/admin/index') ?>">Вход в админку</a>
                <?php else: ?>
                    <a href="<?=Url::to('/admin/index') ?>">Админка</a>
                    <a href="<?=Url::to('/admin/logout') ?>">Выход из админки</a>
                <?php endif ?>
                <a href="#" class="cart">Корзина <span class="cart-product-quantity">(<?=$cart->getTotalCount() ?>)</span></a>
                <form action="<?=Url::to('/category/search') ?>" method="get">
                    <input type="text" style="padding: 5px" placeholder="Поиск..." name="text" value="<?= Yii::$app->getRequest()->getQueryParam('text') ?>">
                </form>
            </div>
        </div>
    </header>
    <div class="conteiner" style="margin-left: auto;margin-right: auto;">
        <?= $content ?>
    </div>
    <footer>
        <div class="container">
            <div class="footer">
                &copy; Все права защищены или типа того
            </div>
        </div>
    </footer>
</section>


<div id="cart" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content" style="padding: 40px;">
        <?= \app\widgets\CartWidget::widget(); ?>
    </div>
  </div>
</div>


<div id="order" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content" style="padding: 40px;">

    </div>
  </div>
</div>
<?php $this->endBody() ?>


</body>
</html>
<?php $this->endPage() ?>
