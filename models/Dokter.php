<?php
/**
 * Created by PhpStorm.
 * User: taufik
 * Date: 9/7/17
 * Time: 8:47 PM
 */

namespace app\models;


use yii\db\ActiveRecord;

class Dokter extends ActiveRecord
{
    public static function tableName()
    {
        return '{{Dokter}}';
    }

    public function rules()
    {
        return [
            [['SPEC'], 'string', 'max' => 200],
            [
                ['SPEC'] ,
                'file' ,
                'skipOnEmpty' => TRUE ,
                'extensions'  => 'jpeg, jpg, png',
            ],
        ];
    }
}