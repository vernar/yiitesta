<?php use yii\helpers\Url; ?>

<?php if (Yii::$app->controller->action->id == 'search'): ?>
    <div style="margin-left: auto;margin-right: auto;width: 500px;" >
        <h3>Поиск по строке: <?= Yii::$app->getRequest()->getQueryParam('text') ?></h3>
    </div>

<?php else: ?>
    <?= \app\widgets\MenuWidget::widget(); ?>
<?php endif ?>
    <div class="container">
        <div class="row justify-content-center">
        <?php /** @var \app\models\Product $productCollection */ ?>
            <?php if (count($productCollection) > 0): ?>
                <?php foreach ($productCollection as $product): ?>
                <div class="col-4">
                    <div class="product">
                        <div class="product-img">
                            <img src="/img/<?= $product->img ?>" alt="Филадельфия">
                        </div>
                        <?php /** @var \app\models\Translate $translator */ ?>
                        <div class="product-name"><?= $translator->getTransLine($product->category) ?> <?= $product->name ?></div>
                        <div class="product-descr">Состав: <?= $product->composition ?></div>
                        <div class="product-price">Цена: <?= $product->price ?> рублей</div>
                        <div class="product-buttons">
                            <a href="#" data-productid="<?=$product->product_id ?>" type="button" class="product-button__add btn btn-success">Заказать</a>
                            <a type="button" href="<?= Url::to(['/product/view/', 'code' =>  $product->link_name]); ?>" class="product-button__more btn btn-primary">
                                Подробнее
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <h4>Ничего не найдено</h4>
            <?php endif; ?>
        </div>
    </div>
