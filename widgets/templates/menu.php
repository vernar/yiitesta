<?php use yii\helpers\Url; ?>
<?php $categoryCode = Yii::$app->getRequest()->getQueryParam('code') ?>
    <div class="container">
        <nav class="nav nav-menu">
            <a class="nav-link" href="/">Всё меню</a>
            <?php foreach ($data as $item): ?>
            <a class="nav-link <?= $categoryCode == $item->cat_name ? 'active' : '' ?>" href="<?= Url::to(['category/view', 'code'=> $item->cat_name]) ?>"><?= $item->string ?></a>
            <?php endforeach; ?>
        </nav>
    </div>