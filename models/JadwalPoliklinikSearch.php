<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JadwalPoliklinik;

class JadwalPoliklinikSearch extends JadwalPoliklinik
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['kd_inst', 'method'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
        $query = JadwalPoliklinik::find()->joinWith('unit as un');
        if (isset($_GET['nama']) and isset($_GET['kategori'])) {
            $query = JadwalPoliklinik::find()->joinWith('unit as un')->joinWith(['dokterpolidetail.dokterfiltername AS dp']);
            $query->andFilterWhere(['like', 'un.KET', $_GET['kategori']]);
        }
        $dataProvider = new ActiveDataProvider([

            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'method' => SORT_ASC,
                ]
            ],
            'pagination' => false
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        return $dataProvider;
    }
}
