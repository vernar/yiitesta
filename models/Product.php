<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 18.01.19
 * Time: 14:28
 */

namespace app\models;


use yii\db\ActiveRecord;
use app\models\Category;
use Yii;
class Product extends ActiveRecord
{

    public $category_id;

    public static function tableName()
    {
        return 'product';
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['cat_name' => 'category']);
    }

    public function getTranslate()
    {
        return $this->hasMany(Translate::className(), ['code' => 'category']);
    }

    public function rules()
    {
        return [
            [['category_id'], 'safe'],
            [['string'], 'safe'],
        ];
    }

    public function getAllProducts(){
        $products = Yii::$app->cache->get('products');
        if (!$products) {
            $products = Product::find()->all();
            Yii::$app->cache->set('products', $products, 10);
        }
        return $products;
    }


    public function getProductsByCategory($codeCategory){
        $productsByCategory = Yii::$app->cache->get('products_category');
        if (!$productsByCategory) {
            $productsByCategory = $products = Product::find()
                ->select('product.*, category.*')
                ->joinWith('category')
                ->where(['category' => $codeCategory])
                ->all();
            Yii::$app->cache->get('products_category', $productsByCategory, 10);
        }
        return $productsByCategory;
    }

    public function getProductBySearch($text){
        $productsByCategory = $products = Product::find()
            ->select('product.*, category.*')
            ->joinWith('category')
            ->joinWith('translate')
            ->orWhere(['like','name', $text])
            ->orWhere(['like','string', $text])
            ->orWhere(['like','composition', $text])
            ->all();

        return $productsByCategory;
    }

    public function getProductByCode($code){
        $product = $products = Product::find()
            ->select('product.*, category.*')
            ->joinWith('category')
            ->where(['link_name' => $code])
            ->one();

        return $product;
    }
}