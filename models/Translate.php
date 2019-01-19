<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 18.01.19
 * Time: 19:42
 */

namespace app\models;


use yii\db\ActiveRecord;

class Translate extends ActiveRecord
{
    public static function tableName()
    {
        return 'translates';
    }

    public function getCategory()
    {
        return $this->hasOne(Translate::className(), ['cat_name' => 'code']);
    }

    public function getTransLine(string $code, $lang = 'ru'){
        return Translate::find()
            ->where(['code' => $code])
            ->andWhere(['language' => $lang])
            ->select(['string'])
            ->one()
            ->string;
    }
}