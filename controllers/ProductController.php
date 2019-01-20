<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 20.01.19
 * Time: 2:28
 */

namespace app\controllers;

use yii\web\Controller;
use app\models\Product;
use app\models\Translate;

class ProductController extends Controller
{
    public $translator;

    public function __construct($id, $module, array $config = [])
    {
        $this->translator = new Translate();
        return parent::__construct($id, $module, $config);
    }

    public function actionView($code){
        $products = new Product();
        $product = $products->getProductByCode($code);
        return $this->render('view',
            [
                'product' => $product,
                'translator' => $this->translator,
            ]
        );
    }


}