<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Dokter;

/**
 * DokterSearch represents the model behind the search form of `app\models\Dokter`.
 */
class DokterSearch extends Dokter
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['KODE', 'Gelar_Depan', 'NAMA', 'Gelar_Belakang', 'NIP', 'ALAMAT', 'KOTA', 'PHONE', 'SPEC', 'BANK', 'NO_AC', 'NAMA_AC', 'KD_UPF', 'KD_KEL', 'Modify_Date', 'Modify_Id', 'Delete_Date', 'Delete_ID', 'Delete_PC', 'Create_Date', 'Create_ID'], 'safe'],
            [['MARGIN', 'PROSHONOR', 'JS_RS', 'JS_MEDL', 'JS_MEDTL'], 'number'],
            [['LDOKTER', 'lSpesialis', 'LNonAktif'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Dokter::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'MARGIN' => $this->MARGIN,
            'PROSHONOR' => $this->PROSHONOR,
            'LDOKTER' => $this->LDOKTER,
            'lSpesialis' => $this->lSpesialis,
            'Modify_Date' => $this->Modify_Date,
            'Delete_Date' => $this->Delete_Date,
            'Create_Date' => $this->Create_Date,
            'LNonAktif' => $this->LNonAktif,
            'JS_RS' => $this->JS_RS,
            'JS_MEDL' => $this->JS_MEDL,
            'JS_MEDTL' => $this->JS_MEDTL,
        ]);

        $query->andFilterWhere(['like', 'KODE', $this->KODE])
            ->andFilterWhere(['like', 'Gelar_Depan', $this->Gelar_Depan])
            ->andFilterWhere(['like', 'NAMA', $this->NAMA])
            ->andFilterWhere(['like', 'Gelar_Belakang', $this->Gelar_Belakang])
            ->andFilterWhere(['like', 'NIP', $this->NIP])
            ->andFilterWhere(['like', 'ALAMAT', $this->ALAMAT])
            ->andFilterWhere(['like', 'KOTA', $this->KOTA])
            ->andFilterWhere(['like', 'PHONE', $this->PHONE])
            ->andFilterWhere(['like', 'SPEC', $this->SPEC])
            ->andFilterWhere(['like', 'BANK', $this->BANK])
            ->andFilterWhere(['like', 'NO_AC', $this->NO_AC])
            ->andFilterWhere(['like', 'NAMA_AC', $this->NAMA_AC])
            ->andFilterWhere(['like', 'KD_UPF', $this->KD_UPF])
            ->andFilterWhere(['like', 'KD_KEL', $this->KD_KEL])
            ->andFilterWhere(['like', 'Modify_Id', $this->Modify_Id])
            ->andFilterWhere(['like', 'Delete_ID', $this->Delete_ID])
            ->andFilterWhere(['like', 'Delete_PC', $this->Delete_PC])
            ->andFilterWhere(['like', 'Create_ID', $this->Create_ID]);

        return $dataProvider;
    }
}
