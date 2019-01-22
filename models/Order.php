<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $order_id
 * @property string $date
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property int $sum
 * @property string $status
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'address'], 'required'],
            [['email'], 'email'],
            [['name', 'email', 'phone', 'address', 'status'], 'string', 'max' => 255],
            [['quantity'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'date' => 'Дата',
            'name' => 'Имя',
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'address' => 'Адрес',
            'sum' => 'Sum',
            'status' => 'Status',
        ];
    }

    public function getOrderProduct()
    {
        return $this->hasMany(OrderProduct::class, ['order_id' => 'order_id']);
    }

    public function getTotalProductQuantityByOrderId($orderId){
//        $productQuote = Order::find()
//            ->select('order.*,order_product.*')
//            ->joinWith('orderProduct')
//            ->where(["order_product.order_id" => $orderId])
//            ->all();

        $totalOrderQuantity = 0;
        $productQuote = OrderProduct::find()
            ->where(["order_product.order_id" => $orderId])
            ->all();

        foreach ($productQuote as $item) {
            $totalOrderQuantity += $item->quantity;
        }
        return $totalOrderQuantity;
    }
}
