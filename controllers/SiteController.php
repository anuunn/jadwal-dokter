<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\JadwalDokterPoli;
use app\models\JadwalDokterPoliDetail;
use app\models\JadwalPoliklinik;
use app\models\JadwalPoliklinikSearch;
use app\models\Unit;
use yii\data\Pagination;

use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        $this->layout = 'main';
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */


    public function actionView($id)
    {
        $model = JadwalPoliklinik::find()->with(['unit'])->where(['id' => $id])->asArray()->one();
        if ($model == null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $query = JadwalDokterPoli::find()->with(['dokter', 'detail' => function ($q) {
            $q->orderBy(['nilai' => SORT_ASC]);
        }])->where(['id_jadwal_poliklinik' => $model['id']]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 15]);
        $dokter = $query->offset($pagination->offset)
            ->limit($pagination->limit)->asArray()->all();
        return $this->renderAjax('view', [
            'model' => "",
            'dokter' => $dokter,
            'pagination' => $pagination,
        ]);
    }

    public function actionIndex()
    {

        $searchModel = new JadwalPoliklinikSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dokterPengganti = JadwalDokterPoli::getDokterPenggantiToday();

        $i = 1;
        $jadwalDokterStorage = [];
        $photodokter = [];
        foreach ($dataProvider->models as $model) :
            $jadwalToday = [];
            $doktername = [];

            foreach ($model->dokterpolidetail as $d) {
               if(isset($d['dokter']['NAMA'])&&isset($d['dokter']['KODE'])){
                $doktername[$d['dokter']['KODE']] = $d['dokter']['NAMA'];
                $photodokter[$d['dokter']['KODE']] = ($d['dokter']['SPEC'] == '') ? 'default.png' : $d['dokter']['SPEC'];
                foreach ($d->detail as $p) {
                    if ($p['jenis'] == 1) {
                        $jadwalToday[$d['dokter']['KODE']][] = \app\models\JadwalDokterPoliDetail::$listhari[$p['nilai']];
                    } else {
                        $jadwalToday[$d['dokter']['KODE']][] = $p['nilai'];
                    }
                }
               }
               
            }
            $print = '';
            foreach ($jadwalToday as $key => $val) {
                if (in_array(\app\models\JadwalDokterPoliDetail::changeDateToDay(date('d')), $val)) {
                    $print = $doktername[$key];
                    foreach ($dokterPengganti as $k => $v) {
                        if ($k == $key and $v != '') {
                            if (array_key_exists($v, $doktername)) {
                                $print = $doktername[$key] . ' digantikan oleh dokter ' . $doktername[$v];
                            }
                        }
                    }
                } else {
                    if (in_array(date('d'), $val)) {
                        $print = $doktername[$key];
                        foreach ($dokterPengganti as $k => $v) {
                            if ($k == $key and $v != '') {
                                $print = $doktername[$key] . ' digantikan oleh dokter ' . $doktername[$v];
                            }
                        }
                    }
                }
            }
            if ($model == null) {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
            $query = JadwalDokterPoli::find()->with(['dokter', 'detail' => function ($q) {
                $q->orderBy(['nilai' => SORT_ASC]);
            }])->where(['id_jadwal_poliklinik' => $model['id']]);
            $count = $query->count();
            $dokter = $query->asArray()->all();
            if (count($dokter) > 0) {
                $no = 1;
                foreach ($dokter as $dp) {
                    if(isset($dp['dokter']['LNonAktif'])){
                        if ($dp['dokter']['LNonAktif'] == '0') {

                            if (count($dp['detail']) > 0) {
                                foreach ($dp['detail'] as $d) {
                                    $jadwalDokterStorage[$i]['detail_dokter'][$no] = [$dp['dokter']['KODE'], $dp['dokter']['NAMA'], $dp['dokter']['SPEC'], $model->unit['KET'], $jadwalToday[$dp['dokter']['KODE']]];
                                }
                            }
                        }
                        $no++;
                    }
                    
                }
            }
            $i++;
        endforeach;
        $data = $jadwalDokterStorage;
        if (\Yii::$app->request->isAjax) {
            // return $this->renderAjax('../site/index', [
            return $this->renderAjax('../site/index-ticker', [
                'data' => $data,
            ]);
        } else {
            // return $this->render('../site/index', [
            return $this->render('../site/index-ticker', [
                'data' => $data,
            ]);
        }
    }

    public function actionTes()
    {
        return $this->render('tes');
    }
}
