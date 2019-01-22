<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_product".
 *
 * @property int $order_product_id
 * @property int $order_id
 * @property int $product_id
 * @property string $name
 * @property int $price
 * @property int $quantity
 * @property int $sum
 */
class OrderProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id'], 'required'],
            [['order_id', 'product_id', 'price', 'quantity', 'sum'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_product_id' => 'Order Product ID',
            'order_id' => 'Order ID',
            'product_id' => 'Product ID',
            'name' => 'Name',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'sum' => 'Sum',
        ];
    }

    public function getOrder()
    {
        return $this->hasOne(Order::class, ['order_id' => 'order_id']);
    }

    public function getProductCollectionByOrderId($orderId){
        $productCollection = OrderProduct::find()
            ->where(['order_id' => $orderId])
            ->all();
        return $productCollection;
    }

}
