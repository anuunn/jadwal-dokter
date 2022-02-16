<?php
namespace app\models;
use Yii;
class JadwalDokterPoli extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'JadwalDokterPoli';
    }
    public function rules()
    {
        return [
            [['id_jadwal_poliklinik', 'kd_dokter'], 'required'],
            [['id_jadwal_poliklinik'], 'integer'],
            [['kd_dokter'], 'string'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_jadwal_poliklinik' => 'Jadwal Poliklinik',
            'kd_dokter' => 'Dokter',
        ];
    }
    function getJadwalpoli()
    {
        return $this->hasOne(JadwalPoliklinik::className(),['id'=>'id_jadwal_poliklinik']);
    }
    function getDokter()
    {
        return $this->hasOne(Dokter::className(),['KODE'=>'kd_dokter'])->where(['LNonAktif' => 0]);
    }

    function getDokterfiltername(){
        if(isset($_GET['nama'])){
           return $this->hasOne(Dokter::className(),['KODE'=>'kd_dokter'])
              ->where("NAMA LIKE '%".$_GET['nama']."%'");
            
         } else {
            return $this->hasOne(Dokter::className(),['KODE'=>'kd_dokter']);
         }
    }
    function getDetail()
    {
        return $this->hasMany(JadwalDokterPoliDetail::className(),['id_jadwal_dokter_poli'=>'id']);
    }

    public static function getDokterPenggantiToday(){
        //$date = date('Y-m-d',strtotime('-1 day',strtotime(date('Y-m-d'))));
        $date = date('Y-m-d');
        $listDokter = JadwalHadirDokterPoliklinik::find()
        //->where("tanggal_jadwal >= '".$date."'")
        ->where("tanggal_jadwal >= '".$date." 00:00:00' AND tanggal_jadwal <= '".$date." 23:59:59'")
        ->all();
        return \yii\helpers\ArrayHelper::map($listDokter,'kd_dokter','kd_dokter_ganti');
    }
}