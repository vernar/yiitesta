<?php

namespace app\widgets;

use app\models\Cart;
use app\models\Product;
use app\models\Translate;
use yii\base\Widget;
class CartWidget extends Widget
{
    public function run()
    {
        return $this->categoriesToHtlm(
            [
                'products' => new Product(),
                'cart' => new Cart(),
                'translator' => new Translate(),
            ]
        );
    }

    public function categoriesToHtlm($data){
        ob_start();
        extract($data);
        include __DIR__ . '/templates/cart.php';
        return ob_get_clean();
    }
}