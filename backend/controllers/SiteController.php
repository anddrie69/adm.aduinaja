<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use  yii\web\Session;
use app\models\ModelAnalytics;
use app\models\ModelKategori;
use backend\components\helper\FunctionHelper;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new ModelAnalytics();
        $model_cat = new ModelKategori();
        $function = new FunctionHelper();

        $session = Yii::$app->session;
        $username = $session->get('username');
        $user_level = $session->get('user_level');
        $category = $session->get('category');
        $kecamatan = $session->get('kecamatan');

        // Count member, user dan aduan serta count dari status aduan
        if($username != null){
            if($user_level == '4'){
                $aduan = $model->getCount('t_aduan', ' WHERE category="'.$category.'"');
                $status_diterima = $model->getCountAduanStatus('1');
                $status_dilaksanakan = $model->getCountAduanStatus('2');
                $status_ditolak = $model->getCountAduanStatus('3');
            }else if($user_level == '5'){
                $aduan = $model->getCount('t_aduan', ' WHERE kecamatan="'.$kecamatan.'"');
                $status_diterima = $model->getCountAduanStatus('1', ' AND kecamatan="'.$kecamatan.'"');
                $status_dilaksanakan = $model->getCountAduanStatus('2', ' AND kecamatan="'.$kecamatan.'"');
                $status_ditolak = $model->getCountAduanStatus('3', ' AND kecamatan="'.$kecamatan.'"');
            }else{
                $aduan = $model->getCount('t_aduan');
                $status_diterima = $model->getCountAduanStatus('1');
                $status_dilaksanakan = $model->getCountAduanStatus('2');
                $status_ditolak = $model->getCountAduanStatus('3');
            }

            $member = $model->getCount('t_member');
            $user = $model->getCount('t_user');
            
            // Count aduan categori
            $arrs_cat = array();
            foreach ($model_cat->getKategori() as $key => $value) {
                
                if($user_level == '5'){
                    $c_aduan_cat = $model->getCountAduanCategory($value['id'], ' AND kecamatan="'.$kecamatan.'"');
                }else{
                    $c_aduan_cat = $model->getCountAduanCategory($value['id']);
                }
                
                $arrs_cat[] = array(
                        'nama' => $value['nama'],
                        'count' => $c_aduan_cat['count']
                    );
            }

            // Count untuk status aduan
            $arrs_sts = array(
                    'Diterima' => $status_diterima['count'],
                    'Dilaksanakan' => $status_dilaksanakan['count'],
                    'Ditolak' => $status_ditolak['count'],
                );

            // get kecamatan
            $getKecamatan = $function->arrsKecamatan();
            $arrs_kec = array();
            foreach ($getKecamatan as $key => $value) {
                $count_kec = $model->getCountAduanKecamatan($value);
                $arrs_kec[] = array(
                        'kec' => $value,
                        'count' => $count_kec['count']
                    );
            }

            // return index
            return $this->render('index', [
                'aduan' => $aduan,
                'member' => $member,
                'user' => $user,
                'count_category' => $arrs_cat,
                'count_status' => $arrs_sts,
                'count_kec' => $arrs_kec
            ]);
        }else{
            // permasalahannya ada di siini.
            return $this->redirect(Url::to(['login/index']));
        }
    }

    public function actionLogout()
    {
        $session = Yii::$app->session;
        $session->destroy();
        $session->remove('id');
        $session->remove('nik');
        $session->remove('nama');
        $session->remove('username');
        $session->remove('user_level');
        return $this->redirect('/');
    }
}
