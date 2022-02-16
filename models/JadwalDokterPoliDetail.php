<?php
namespace app\models;
use Yii;
class JadwalDokterPoliDetail extends \yii\db\ActiveRecord
{
    public $hari;
    public $tanggal;
    public static $listhari=[
        1=>'Senin',
        2=>'Selasa',
        3=>'Rabu',
        4=>'Kamis',
        5=>'Jumat',
        6=>'Sabtu',
        7=>'Minggu',
    ];
    public static function tableName()
    {
        return 'JadwalDokterPoliDetail';
    }
    public function rules()
    {
        return [
            [['id_jadwal_dokter_poli', 'jenis', 'nilai'], 'required'],
            [['id_jadwal_dokter_poli', 'nilai','hari','tanggal'], 'integer'],
            [['jenis', 'keterangan'], 'string'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_jadwal_dokter_poli' => 'Jadwal Dokter Poli',
            'jenis' => 'Jenis',
            'nilai' => 'Nilai',
            'keterangan' => 'Keterangan',
        ];
    }
    function getDokterpoli()
    {
        return $this->hasOne(JadwalDokterPoli::className(),['id'=>'id_jadwal_dokter_poli']);
    }

    public static function changeDateToDay($date = null){
        if(empty($date) OR $date == ''){
            return null;
        } else {
            if($date < 10){
                $date = $date;
            }

            date_default_timezone_set("Asia/Jakarta");
            $setDate = date('l',strtotime(date('Y-m-').$date));
            
            $day = [
                'Monday' => 1,
                'Tuesday' => 2,
                'Wednesday' => 3,
                'Thursday' => 4,
                'Friday' => 5,
                'Saturday' => 6,
                'Sunday' => 7,
            ];

            $JadwalDokterPoliDetail = new JadwalDokterPoliDetail();
            return $JadwalDokterPoliDetail::$listhari[$day[$setDate]];
        }
    }
}
