<h2 style="padding: 10px; text-align: center">Корзина</h2>

<?php /** @var \app\models\Cart $cart */ ?>
<?php if (is_array($cart->getCartArray()) && count($cart->getCartArray()) > 0): ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Фото</th>
            <th scope="col">Наименование</th>
            <th scope="col">Количество</th>
            <th scope="col">Цена</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php /** @var \app\models\Cart $cart */ ?>
        <?php foreach ($cart->getCartArray() as $productId => $productCount): ?>
        <?php /** @var \app\models\Product $products */ ?>
        <?php $product = $products->getProductById($productId) ?>
            <tr>
                <td style="vertical-align: middle" width="150"><img src="/img/<?= $product->img ?>"></td>
                <td style="vertical-align: middle"><?= $translator->getTransLine($product->category) ?> <?= $product->name ?></td>
                <td style="vertical-align: middle"><?=$productCount ?></td>
                <td style="vertical-align: middle"><?= $product->price ?></td>
                <td class="delete cart-delete" data-productid="<?=$product->product_id ?>" style="text-align: center; cursor: pointer; vertical-align: middle; color: red">
                    <span>
                         &#10006;
                    </span>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr style="border-top: 4px solid black">
            <td colspan="4">Всего товаров</td>
            <td class="total-quantity"><?=$cart->getTotalCount() ?></td>
        </tr>
        <tr>
            <td colspan="4">На сумму </td>
            <td style="font-weight: 700"><?=$cart->getTotalPrice() ?></td>
        </tr>
        </tbody>
    </table>
    <div class="modal-buttons" style="display: flex; padding: 15px; justify-content: space-around">
        <a href="#" type="button" class="btn btn-danger" onclick="clearCart(event)">Очистить корзину</a>
        <button type=" button" class="btn btn-secondary btn-close" onclick="$('#cart').modal('hide')" >Продолжить покупки</button>
        <button type="button" class="btn btn-success btn-next" onclick="createOrder(event)">Оформить заказ</button>
    </div>
<?php else: ?>
<h2>Корзина пуста =(</h2>
    <div class="modal-buttons" style="display: flex; padding: 15px; justify-content: space-around">
        <button type=" button" class="btn btn-secondary btn-close" onclick="$('#cart').modal('hide')">Продолжить покупки</button>
    </div>
<?php  endif ?>


<script type="application/javascript">
    window.onload = function() {
        startCartObserver();
    };
</script>