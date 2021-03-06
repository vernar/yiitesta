<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 18.01.19
 * Time: 14:28
 */

namespace app\controllers;

use yii\web\Controller;
use app\models\Product;
use app\models\Translate;
use Yii;

class CategoryController extends Controller
{
    public $translator;
    public $title;

    public function __construct($id, $module, array $config = [])
    {
        $this->translator = new Translate();
        Yii::$app->view->title = 'Категория ';
        return parent::__construct($id, $module, $config);
    }


    public function actionIndex(){
        $products = new Product();
        $productCollection = $products->getAllProducts();
        return $this->render('view',
            [
                'productCollection' => $productCollection,
                'translator' => $this->translator,
            ]
        );
    }

    public function actionView($code){
        $products = new Product();
        $productCollection = $products->getProductsByCategory($code);
        Yii::$app->view->title .= $this->translator->getTransLine($code);
        return $this->render('view',
            [
                'productCollection' => $productCollection,
                'translator' => $this->translator,
            ]
        );
    }

    public function actionSearch($text){
        $text = \yii\helpers\Html::encode($text);
        $products = new Product();
        return $this->render('view',
            [
                'productCollection' => $products->getProductBySearch($text),
                'translator' => $this->translator,
            ]
        );
    }
}