<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use app\models\ModelLogin;
use yii\web\Session;
use yii\helpers\Url;

/**
 * Site controller
 */
class LoginController extends Controller
{

    public function actionIndex()
    {
        $model = new ModelLogin();
        $session = Yii::$app->session;
        
        $username = '';
        $warning = '';
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->LoginUser()) {
                $warning = 'Login Berhasil';
                $username = $session->get('username');
                return $this->redirect('/');
            }else{
                $warning = '<div style="background: #fdcbcb none repeat scroll 0 0;color: #f00;margin-bottom: 5px;padding: 10px;text-align: center;">Mohon Maaf username dan password anda salah.</div>';
                $username = '';
            }
            return $this->render('index',['warning' => $warning, 'username' => $username]);
        }
        return $this->render('index',['warning' => $warning, 'username' => $username]);
    }

}
