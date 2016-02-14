<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use  yii\web\Session;
use yii\helpers\Url;
use app\models\ModelMember;
use app\models\ModelAduan;
use app\models\ModelAnalytics;
use app\models\ModelKategori;


/**
 * Site controller
 */
class MemberController extends Controller
{

    public function actionIndex()
    {
        $model = new ModelMember();
        
        $session = Yii::$app->session;
        $username = $session->get('username');
        if($username != null){
            $member = $model->getMember();
            return $this->render('index', [
                'data' => $member,
            ]);
        }else{
            return $this->redirect(Url::to(['login/index']));
        }
    }

    public function actionDetail()
    {
        $model = new ModelMember();
        $model_aduan = new ModelAduan();
        $model_analytics = new ModelAnalytics();
        $model_cat = new ModelKategori();

        $request = Yii::$app->request;
        
        $session = Yii::$app->session;
        $username = $session->get('username');
        if($username != null){
            $member = $model->getSingleMember($request->get('id'));
            $aduan = $model_aduan->getAduanMember($request->get('id'));

            // Count aduan categori
            $arrs_cat = array();
            foreach ($model_cat->getKategori() as $key => $value) {
                
                $c_aduan_cat = $model_analytics->getCountAduanCategory($value['id'], ' AND member="'.$request->get('id').'"');
                $arrs_cat[] = array(
                        'nama' => $value['nama'],
                        'count' => $c_aduan_cat['count']
                    );
            }

            // Count aduan status
            $status_diterima = $model_analytics->getCountAduanStatus('1', ' AND member="'.$request->get('id').'"');
            $status_dilaksanakan = $model_analytics->getCountAduanStatus('2', ' AND member="'.$request->get('id').'"');
            $status_ditolak = $model_analytics->getCountAduanStatus('3', ' AND member="'.$request->get('id').'"');
            $arrs_sts = array(
                    'Diterima' => $status_diterima['count'],
                    'Dilaksanakan' => $status_dilaksanakan['count'],
                    'Ditolak' => $status_ditolak['count'],
                );

            return $this->render('detail', [
                'data' => $member,
                'data_aduan' => $aduan,
                'count_category' => $arrs_cat,
                'count_status' => $arrs_sts,
            ]);
        }else{
            return $this->redirect(Url::to(['login/index']));
        }
    }
}
