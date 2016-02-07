<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use  yii\web\Session;
use app\models\ModelAnalytics;

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

        $session = Yii::$app->session;
        $username = $session->get('username');
        if($username != null){
            $aduan = $model->getCount('t_aduan');
            $member = $model->getCount('t_member');
            $user = $model->getCount('t_user');
            return $this->render('index', [
                'aduan' => $aduan,
                'member' => $member,
                'user' => $user,
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
