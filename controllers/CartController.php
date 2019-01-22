<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 20.01.19
 * Time: 3:54
 */

namespace app\controllers;


use app\models\Cart;
use app\models\Order;
use app\models\OrderProduct;
use app\models\Product;
use app\models\Translate;
use yii\helpers\Url;
use yii\swiftmailer\Mailer;
use yii\web\Controller;
use Yii;

class CartController extends Controller
{

    public $translator;
    public $cart;
    public $product;
    public $order;
    public $orderProduct;

    public function __construct($id, $module, array $config = [])
    {
        $this->translator = new Translate();
        $this->cart = new Cart();
        $this->product = new Product();
        $this->order = new Order();
        $this->orderProduct = new OrderProduct();
        return parent::__construct($id, $module, $config);
    }

    public function actionOrder(){
        $this->layout = 'empty-layout';
        return $this->render('order',
            [
                'order' => $this->order,
                'translator' => $this->translator,
            ]
        );
    }

    public function actionSubmit(){
        if( $this->order->load(Yii::$app->request->post())) {
            $this->order->date = date('Y-m-d H:i:s');
            $this->order->sum = $this->cart->getTotalPrice();
            if($this->order->save()){

                foreach($this->cart->getCartArray() as $productId => $productCount){
                    /** @var Product $product */
                    $product = $this->product->getProductById($productId);

                    $orderProductSave = new OrderProduct();
                    $orderProductSave->order_id = $this->order->order_id;
                    $orderProductSave->product_id = $productId;
                    $orderProductSave->name = $product->name;
                    $orderProductSave->price = $product->price;
                    $orderProductSave->quantity = $productCount;
                    $orderProductSave->sum = $product->price * $productCount;
                    $orderProductSave->save();
                }

                Yii::$app->mail
                    ->compose('order_mail',
                        [
                            'order' => $this->order,
                            'orderProduct' => $this->orderProduct,
                            'translator' => $this->translator,
                        ])
                    ->setCharset('utf-8')
                    ->setFrom(['admin@shop.com' => 'Admin Rutovich'])
                    ->setTo($this->order->email)
                    ->setSubject('Ваш заказ №' . $this->order->order_id . ' поставлен в очередь')
                    ->send();
                $this->cart->flushCart();
                return $this->render('success',
                    [
                        'order' => $this->order,
                        'translator' => $this->translator,
                    ]
                );
            }
        } else {
            return Yii::$app->response->redirect(Url::to('/'));
        }
    }

    public function actionAdd($productid){
        $this->cart->addToCart($productid);

        return \app\widgets\CartWidget::widget();
    }

    public function actionDel($productid){
        $this->cart->deleteProductFromCart($productid);

        return \app\widgets\CartWidget::widget();
    }

    public function actionFlush(){
        $this->cart->flushCart();

        return \app\widgets\CartWidget::widget();
    }
}