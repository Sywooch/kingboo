<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%currencies}}".
 *
 * @property integer $id
 * @property string $name_ru
 * @property string $name_en
 * @property string $code
 * @property string $symbol
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%currencies}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_ru', 'name_en', 'code', 'symbol'], 'required'],
            [['name_ru', 'name_en'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 3],
            [['symbol'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common_models', 'ID'),
            'name_ru' => Yii::t('common_models', 'Name Ru'),
            'name_en' => Yii::t('common_models', 'Name En'),
            'code' => Yii::t('common_models', 'Code'),
            'symbol' => Yii::t('common_models', 'Symbol'),
        ];
    }

    /**
    * Возвращает options для использования модели в селектах array(id=>name)
    * 
    */
    public static function getOptions($name = 'name') {
        $array = self::find()->asArray()->all();
        if ($name == 'name') {
            $name = 'name_' . Lang::$current->url;
        }
        $result = [];
        foreach ($array as $v) {
            $result[$v['id']] = $v[$name];
        }
        return $result;
    }
    
    /**
    * Возвращает массив объектов, закодированный для JavaScript
    * 
    */
    public static function getJsObjects() {
        return json_encode(array_map(function($el) {
            return $el->attributes;
        },self::find()->all()));
    }
}
