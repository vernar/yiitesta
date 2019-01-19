<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 18.01.19
 * Time: 16:08
 */

namespace app\widgets;


use app\models\Category;
use yii\base\Widget;
class MenuWidget extends Widget
{
    public $data;

    public function run()
    {
        $categories = new Category();
        $this->data = $this->categoriesToHtlm($categories->getCategories());
        return $this->data;
    }

    public function categoriesToHtlm($data){
        ob_start();
        include __DIR__ . '/templates/menu.php';
        return ob_get_clean();
    }
}