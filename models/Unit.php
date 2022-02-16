<?php
/**
 * Created by PhpStorm.
 * User: taufik
 * Date: 9/7/17
 * Time: 8:47 PM
 */

namespace app\models;


use yii\db\ActiveRecord;

class Unit extends ActiveRecord
{

    // X : 3601
    // 3301 3302 3901 3405?

    public static $penunjangID = [
        '4002',
        '3001',
        '3002',
        '3101',
        '3102',
        '3301',
        '3302',
        '4003',
        '4004',
        '3401',
        '3402',
        '3403',
        '3404',
        '3405',
        '3407',
        '3408',
        '3409',
        '3410',
        '3411',
        '3412'
    ];

    public static function tableName()
    {
        return '{{UNIT}}';
    }

    public static function getNama($kode)
    {
        $poli = self::find()->where(['KD_INST'=>$kode])->one();
        if($poli){
            return $poli->KET;
        }else
            return null;
    }

    public static function getUnit($kode)
    {
        $poli = self::find()->where(['KD_INST'=>$kode])->one();
        if($poli){
            return $poli;
        }else
            return null;
    }

    public static function isPenunjang($id)
    {
        if(in_array($id,self::$penunjangID)){
            return true;
        }else{
            return false;
        }
//        return VwInstPenunjang::isPenunjang($id);

//        $unit = self::find()->select(['KD_INST','LPENUNJANG'])->where(['KD_INST'=>$id])->one();
//        if($unit){
//            if($unit->LPENUNJANG == 1){
//                return true;
//            }else{
//                return false;
//            }
//        }else{
//            return false;
//        }
    }

}