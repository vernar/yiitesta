<?= \app\widgets\MenuWidget::widget(); ?>
<div class="container">
    <div class="row justify-content-md-center">

        <div class="col-8 justify-self-center">
            <h2><div class="product-title"><?= $translator->getTransLine($product->category) ?> <?= $product->name ?></div></h2>
            <div class="product">
                <div class="product-img">
                    <img src="/img/<?= $product->img ?>" alt="Филадельфия">
                </div>
                <div class="product-name"><?= $product->name ?> </div>
                <div class="product-descr">Состав: <?= $product->composition ?></div>
                <div class="product-descr">Описание: <?= $product->descr ?></div>
                <div class="product-price">Цена: <?= $product->price ?></div>
                <div class="product-buttons">
                    <button type="button" class="product-button__add btn btn-success">Заказать</button>
                </div>
            </div>
        </div>
    </div>
</div>