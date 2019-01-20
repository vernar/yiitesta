<?php use yii\widgets\ActiveForm; ?>
<?php /** @var \app\models\Order $order */  ?>

<h2>Оформление заказа</h2>
<?php $form = ActiveForm::begin() ?>
<?php $form->action = \yii\helpers\Url::to('/cart/submit') ?>

<?= $form->field($order,'name') ?>
<?= $form->field($order,'email') ?>
<?= $form->field($order,'phone') ?>
<?= $form->field($order,'address') ?>

<button class="btn btn-success">Оформить заказ</button>
<?php ActiveForm::end(); ?>
