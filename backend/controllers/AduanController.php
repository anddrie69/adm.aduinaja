<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use  yii\web\Session;
use yii\helpers\Url;
use app\models\ModelAduan;

/**
 * Site controller
 */
class AduanController extends Controller
{

    public function actionIndex()
    {
    	$model = new ModelAduan();
        
        $session = Yii::$app->session;
        $username = $session->get('username');
        if($username != null){
            $member = $model->getAduan();
            return $this->render('index', [
                'data' => $member,
            ]);
        }else{
            return $this->redirect(Url::to(['login/index']));
        }
        
    }

    public function actionEdit()
    {
        $model = new ModelAduan();
        
        $session = Yii::$app->session;
        $username = $session->get('username');
        
        if($username != null){
            $request = Yii::$app->request;
            
            $getAduan = $model->getSingleAduan($request->get('id'));

            if ($model->load(Yii::$app->request->post())) {
                $model->updateStatusAduan();
                return $this->redirect(Url::to(['aduan/edit', 'id' => $request->get('id')]));

            }else{
                return $this->render('edit', [
                    'data' => $getAduan,
                ]);
            }
        
        }else{
            return $this->redirect(Url::to(['login/index']));
        }
    }
}
