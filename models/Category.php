<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 18.01.19
 * Time: 16:09
 */

namespace app\models;


use yii\db\ActiveRecord;
use app\models\Translate;

class Category extends ActiveRecord
{
    public $string;



    public static function tableName()
    {
        return 'category';
    }

    public function getTranslate()
    {
        return $this->hasMany(Translate::className(), ['code' => 'cat_name']);
    }

    public function rules()
    {
        return [
            [['string'], 'safe'],
        ];
    }


    public function getCategories($language = 'ru'){
        $result = Category::find()
            ->select('category.*, translates.*')
            ->with('translate')
            ->leftJoin('translates', '`category`.`cat_name` = `translates`.`code`')
            ->where(['language' => $language])
            ->all()
            ;
        return $result;
    }
}