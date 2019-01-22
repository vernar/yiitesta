<?php /** @var \app\models\Order $order */ ?>
<?php /** @var \app\models\OrderProduct $orderProduct */ ?>
<h3>Ваш заказ под номером <?=$order->order_id?> принят</h3>
Ваш телефон: <?=$order->phone?>

<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th style="padding: 8px; border: 1px solid #ddd">Наименование</th>
            <th style="padding: 8px; border: 1px solid #ddd">Количество</th>
            <th style="padding: 8px; border: 1px solid #ddd">Цена</th>
            <th style="padding: 8px; border: 1px solid #ddd">Сумма</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($orderProduct->getProductCollectionByOrderId($order->order_id) as $quote): ?>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd">
                    <?=$quote->name?></td>
                <td style="padding: 8px; border: 1px solid #ddd"><?=$quote->quantity?></td>
                <td style="padding: 8px; border: 1px solid #ddd"><?=$quote->price ?> рублей</td>
                <td style="padding: 8px; border: 1px solid #ddd"><?=$quote->sum ?> рублей</td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3">Итого:</td>
            <td><?= $order->getTotalProductQuantityByOrderId($order->order_id) ?> шт</td>
        </tr>
        <tr>
            <td colspan="3">На сумму:</td>
            <td><b><?=$order->sum ?></b> рублей</td>
        </tr>
        </tbody>
    </table>

</div>