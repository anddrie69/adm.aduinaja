<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use  yii\web\Session;
use yii\helpers\Url;
use app\models\ModelMember;

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
}
