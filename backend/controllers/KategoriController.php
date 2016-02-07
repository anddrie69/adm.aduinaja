<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use app\models\ModelKategori;
use  yii\web\Session;
use yii\helpers\Url;

/**
 * Site controller
 */
class KategoriController extends Controller
{

    public function actionIndex()
    {
        $model = new ModelKategori();

        $session = Yii::$app->session;
        $username = $session->get('username');
        if($username != null){
            if ($model->load(Yii::$app->request->post())) {
                $kategori = $model->AddNewKategori();
            }

            $data = $model->getKategori();
            return $this->render('index', [
                'data' => $data,
                'edit' => '',
            ]);
        }else{
            return $this->redirect(Url::to(['login/index']));
        }
    }

    public function actionDelete(){

        $model = new ModelKategori();

        $session = Yii::$app->session;
        $username = $session->get('username');
        if($username != null){
            $request = Yii::$app->request;
            $model->deleteKategori($request->get('id'));
            $data = $model->getKategori();
            return $this->render('index', [
                'data' => $data,
                'edit' => ''
            ]);
        }else{
            return $this->redirect(Url::to(['login/index']));
        }
    }

    public function actionEdit()
    {
        $model = new ModelKategori();

        $session = Yii::$app->session;
        $username = $session->get('username');
        if($username != null){
            $request = Yii::$app->request;
            if ($model->load(Yii::$app->request->post())) {
                $model->updateKategori($request->get('id'));
            }
            $data = $model->getKategori();
            $edit = $model->getSingleKategori($request->get('id'));
            return $this->render('index', [
                'data' => $data,
                'edit' => $edit,
            ]);
        }else{
            return $this->redirect(Url::to(['login/index']));
        }
    }
}
