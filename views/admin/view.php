<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = 'Заказ № ' . $model->order_id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <a href="<?=\yii\helpers\Url::to('/admin/') ?>" class="btn btn-default">Назад</a>
        <?= Html::a('Обновить', ['update', 'id' => $model->order_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->order_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'order_id',
            'date',
            'name',
            'email:email',
            'phone',
            'address',
            'sum',
            'status',
        ],
    ]) ?>
    <hr>
    <h3>Состав заказа</h3>

    <?php $products = $model->orderProduct ?>
    <?php /** @var \app\models\OrderProduct $product */ ?>
    <?php foreach($products as $product): ?>
        <div>-<?= $product->name; ?> в колличестве <?=$product->quantity?>шт. На сумму <?=$product->sum?> рублей</div>
    <?php endforeach; ?>

</div>
