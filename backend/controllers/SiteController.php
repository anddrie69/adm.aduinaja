<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use  yii\web\Session;
use app\models\ModelAnalytics;
use app\models\ModelKategori;

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

        $session = Yii::$app->session;
        $username = $session->get('username');
        if($username != null){
            $aduan = $model->getCount('t_aduan');
            $member = $model->getCount('t_member');
            $user = $model->getCount('t_user');
            
            $arrs_cat = array();
            foreach ($model_cat->getKategori() as $key => $value) {
                
                $c_aduan_cat = $model->getCountAduanCategory($value['id']);
                $arrs_cat[] = array(
                        'nama' => $value['nama'],
                        'count' => $c_aduan_cat['count']
                    );
            }

            $status_diterima = $model->getCountAduanStatus('1');
            $status_dilaksanakan = $model->getCountAduanStatus('2');
            $status_ditolak = $model->getCountAduanStatus('3');

            $arrs_sts = array(
                    'Diterima' => $status_diterima['count'],
                    'Dilaksanakan' => $status_dilaksanakan['count'],
                    'Ditolak' => $status_ditolak['count'],
                );

            return $this->render('index', [
                'aduan' => $aduan,
                'member' => $member,
                'user' => $user,
                'count_category' => $arrs_cat,
                'count_status' => $arrs_sts
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
