<?php use yii\helpers\Url; ?>
    <div class="container">
        <nav class="nav nav-menu">
            <a class="nav-link active" href="/">Всё меню</a>
            <?php foreach ($data as $item): ?>
            <a class="nav-link" href="<?= Url::to(['category/view', 'code'=> $item->cat_name]) ?>"><?= $item->string ?></a>
            <?php endforeach; ?>
        </nav>
    </div>