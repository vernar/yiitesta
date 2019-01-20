<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 20.01.19
 * Time: 4:37
 */

namespace app\models;


use yii\db\ActiveRecord;
use Yii;

class Cart extends ActiveRecord
{
    protected $session;
    protected $cartCollection;

    public function __construct( $config = [])
    {
        $this->session = Yii::$app->session;
        $this->session->open();
        parent::__construct($config);
    }

    public function addToCart($productId){
        $sс = $this->session['cart'];

        if (isset($sс[$productId])) {
            $temp = is_array($sс)? $sс : [];
            $temp[$productId] += 1;
            $this->session['cart'] = $temp;
        } else {
            $temp = is_array($sс)? $sс : [];
            $this->session['cart'] = [$productId => 1] + $temp;
        }
    }

    public function getCartArray(){
        return $this->session['cart'];
    }

    public function deleteProductFromCart($productId){
        $sс = $this->session['cart'];
        $temp = is_array($sс)? $sс : [];
        unset($temp[$productId]);
        $this->session['cart'] = $temp;
    }

    public function getTotalCount(){
        $totalCount = 0;
        foreach ($this->session['cart'] as $productId => $count){
            $totalCount += $count;
        }

        return $totalCount;
    }

    public function getTotalPrice(){
        $totalPrice = 0;
        $products = new Product();
        foreach ($this->session['cart'] as $productId => $count){
            $product = $products->getProductById($productId);
            $totalPrice += $product->price * $count;
        }

        return $totalPrice;
    }

    public function flushCart(){
        unset( $this->session['cart']);
    }
}