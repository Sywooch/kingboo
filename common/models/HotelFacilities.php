<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%hotel_facilities}}".
 *
 * @property integer $id
 * @property string $name_ru
 * @property string $name_en
 * @property integer $group_id
 * @property integer $important
 * @property integer $order
 */
class HotelFacilities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%hotel_facilities}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_ru', 'name_en', 'group_id'], 'required'],
            [['important', 'order'], 'integer'],
            [['group_id'], 'integer', 'min' => 1, 'max' => 5],
            [['name_ru', 'name_en'], 'string', 'max' => 255],
            [['group_id', 'name_ru'], 'unique', 'targetAttribute' => ['group_id', 'name_ru'], 'message' => 'The combination of Name Ru and Group ID has already been taken.'],
            [['group_id', 'name_en'], 'unique', 'targetAttribute' => ['group_id', 'name_en'], 'message' => 'The combination of Name En and Group ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('hotels', 'ID'),
            'name_ru' => Yii::t('hotels', 'Name Ru'),
            'name_en' => Yii::t('hotels', 'Name En'),
            'group_id' => Yii::t('hotels', 'Group ID'),
            'important' => Yii::t('hotels', 'Important'),
            'order' => Yii::t('hotels', 'Order'),
        ];
    }
    
    public function getGroup() {
        return \common\components\ListFacilitiesType::option($this->group_id);
    }

    /**
    * Возвращает записи из таблицы в виде массива, название на текущем языке дает в свойстве name
    * В каждой возвращаемой записи есть поле checked, оно равно true если id найден как ключ в массиве $checked
    * 
    */
    public static function options($where = false, $checked = []) {
        if ($where) {
            $a = self::find()->asArray()->Where($where)->orderBy('order')->all();
        } else {
            $a = self::find()->asArray()->orderBy('order')->all();
        }
        $name = 'name_' . Lang::$current->url;
        foreach ($a as $k=>$v) {
            $a[$k]['name'] = $v[$name];
            $a[$k]['checked'] = key_exists($v['id'], $checked);
        }
        return $a;
    }
    
    /**
    * Возвращает массив объектов, закодированный для JavaScript
    * 
    */
    public static function jsObjects() {
        return json_encode(array_map(function($el) {
            return $el->attributes;
        },self::find()->all()));
    }

}
