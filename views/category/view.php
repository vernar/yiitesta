
<?= \app\widgets\MenuWidget::widget(); ?>
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
                            <button type="button" class="product-button__add btn btn-success">Заказать</button>
                            <button type="button" class="product-button__more btn btn-primary">Подробнее</button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <h4>Ничего не найдено</h4>
            <?php endif; ?>
        </div>
    </div>
