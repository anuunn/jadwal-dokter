<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jadwal_hadir_dokter_poliklinik".
 *
 * @property int $id
 * @property string $kd_inst
 * @property string $kd_dokter
 * @property string $tanggal_jadwal
 * @property string|null $tanggal_hadir_mulai
 * @property string|null $tanggal_hadir_selesai
 * @property string|null $kd_dokter_ganti
 * @property string $create_id
 * @property string $create_date
 * @property string|null $modify_id
 * @property string|null $modify_date
 */
class JadwalHadirDokterPoliklinik extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jadwal_hadir_dokter_poliklinik';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kd_inst', 'kd_dokter', 'tanggal_jadwal', 'create_id', 'create_date'], 'required'],
            [['tanggal_jadwal', 'tanggal_hadir_mulai', 'tanggal_hadir_selesai', 'create_date', 'modify_date'], 'safe'],
            [['kd_inst'], 'string', 'max' => 4],
            [['kd_dokter', 'kd_dokter_ganti'], 'string', 'max' => 50],
            [['create_id', 'modify_id'], 'string', 'max' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kd_inst' => 'Kd Inst',
            'kd_dokter' => 'Kd Dokter',
            'tanggal_jadwal' => 'Tanggal Jadwal',
            'tanggal_hadir_mulai' => 'Tanggal Hadir Mulai',
            'tanggal_hadir_selesai' => 'Tanggal Hadir Selesai',
            'kd_dokter_ganti' => 'Kd Dokter Ganti',
            'create_id' => 'Create ID',
            'create_date' => 'Create Date',
            'modify_id' => 'Modify ID',
            'modify_date' => 'Modify Date',
        ];
    }
}
