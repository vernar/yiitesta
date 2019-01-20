<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 20.01.19
 * Time: 3:54
 */

namespace app\controllers;


use app\models\Cart;
use app\models\Product;
use app\models\Translate;
use yii\web\Controller;


class CartController extends Controller
{

    public $translator;
    public $cart;
    public $product;

    public function __construct($id, $module, array $config = [])
    {
        $this->translator = new Translate();
        $this->cart = new Cart();
        $this->product = new Product();
        return parent::__construct($id, $module, $config);
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