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
use Yii;

class ProductController extends Controller
{
    public $translator;

    public function __construct($id, $module, array $config = [])
    {
        $this->translator = new Translate();
        Yii::$app->view->title = 'Продукт ';
        return parent::__construct($id, $module, $config);
    }

    public function actionView($code){
        $products = new Product();
        $product = $products->getProductByCode($code);
        Yii::$app->view->title .= $this->translator->getTransLine($product->category) . ' ' . $product->name;
        return $this->render('view',
            [
                'product' => $product,
                'translator' => $this->translator,
            ]
        );
    }


}