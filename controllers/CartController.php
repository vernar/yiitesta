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
use app\models\Product;
use app\models\Translate;
use yii\helpers\Url;
use yii\web\Controller;
use Yii;

class CartController extends Controller
{

    public $translator;
    public $cart;
    public $product;
    public $order;

    public function __construct($id, $module, array $config = [])
    {
        $this->translator = new Translate();
        $this->cart = new Cart();
        $this->product = new Product();
        $this->order = new Order();
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
                Yii::$app->mailer
                    ->compose()
                    ->setCharset('utf-8')
                    ->setFrom(['admin@shop.com' => 'Admin Rutovich'])
                    ->setTo($this->order->email)
                    ->setSubject('Ваш заказа №' . $this->order->order_id . ' поставлен в очередь')
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