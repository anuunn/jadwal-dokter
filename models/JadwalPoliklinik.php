<?php
namespace app\models;
use Yii;
class JadwalPoliklinik extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'JadwalPoliklinik';
    }
    public function rules()
    {
        return [
            [['kd_inst', 'method'], 'required','message'=>'{attribute} tidak boleh kosong'],
            [['kd_inst', 'method'], 'string'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kd_inst' => 'Nama Poli',
            'method' => 'Waktu Pelayanan',
        ];
    }
    function getUnit()
    {
        return $this->hasOne(Unit::className(),['KD_INST'=>'kd_inst']);
    }
    function getDokterpoli()
    {
        return $this->hasMany(JadwalDokterPoli::className(),['id_jadwal_poliklinik'=>'id']);
    }

    
    function getDokterpolidetail()
    {
        return $this->hasMany(JadwalDokterPoli::className(),['id_jadwal_poliklinik'=>'id'])->with(['dokterfiltername']);
    }
}