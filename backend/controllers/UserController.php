<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Session;
use yii\helpers\Url;
use app\models\ModelUser;
use app\models\ModelKategori;
use backend\components\helper\FunctionHelper;

/**
 * Site controller
 */
class UserController extends Controller
{

    public function actionIndex()
    {
        $model = new ModelUser();
        
        $session = Yii::$app->session;
        $username = $session->get('username');
        if($username != null){
            $user = $model->getUser();
            return $this->render('index', [
                'data' => $user,
            ]);
        }else{
            return $this->redirect(Url::to(['login/index']));
        }
    }

    public function actionAddnew()
    {
    	$model = new ModelUser();
        $modelKat = new ModelKategori();
        $function = new FunctionHelper();
        $getKecamatan = $function->arrsKecamatan();

        $getKategori = $modelKat->getKategori();

        $session = Yii::$app->session;
        $username = $session->get('username');
        $warning = '';
        if($username != null){
            if ($model->load(Yii::$app->request->post())) {
                $model->AddNewUser();
                return $this->redirect(Url::to(['user/index']));
            }

            return $this->render('AddNew', [
                'data' => $model,
                'warning' => $warning,
                'getKategori' => $getKategori,
                'getKecamatan' => $getKecamatan,
            ]);
        }else{
            return $this->redirect(Url::to(['login/index']));
        }

    }

    public function actionDelete(){

        $model = new ModelUser();
        
        $session = Yii::$app->session;
        $username = $session->get('username');
        if($username != null){
            $request = Yii::$app->request;

            $model->deleteUser($request->get('id'));

            $user = $model->getUser();
            return $this->render('index', [
                'data' => $user,
            ]);
        }else{
            return $this->redirect(Url::to(['login/index']));
        }
    }

    public function actionEdit()
    {
        $model = new ModelUser();
        $modelKat = new ModelKategori();
        $function = new FunctionHelper();
        $getKecamatan = $function->arrsKecamatan();
        
        $session = Yii::$app->session;
        $username = $session->get('username');
        $warning = '';
        if($username != null){
            $request = Yii::$app->request;
            
            $getUser = $model->getSingleUser($request->get('id'));
            $getKategori = $modelKat->getKategori();

            if ($model->load(Yii::$app->request->post())) {
                $model->updateUser($request->get('id'));
                return $this->redirect(Url::to(['user/edit', 'id' => $request->get('id')]));
            }
            

            return $this->render('edit', [
                'data' => $getUser,
                'warning' => $warning,
                'getKategori' => $getKategori,
                'getKecamatan' => $getKecamatan
            ]);
        }else{
            return $this->redirect(Url::to(['login/index']));
        }
    }

    public function actionProfile()
    {
        $model = new ModelUser();
        $modelKat = new ModelKategori();
        
        $session = Yii::$app->session;
        $username = $session->get('username');
        $warning = '';
        if($username != null){
            $request = Yii::$app->request;
            
            $getUser = $model->getSingleUser($request->get('id'));
            $getKategori = $modelKat->getKategori();

            if ($model->load(Yii::$app->request->post())) {
                $model->updateUser($request->get('id'));
                return $this->redirect(Url::to(['user/edit', 'id' => $request->get('id')]));
            }
            

            return $this->render('edit', [
                'data' => $getUser,
                'warning' => $warning,
                'getKategori' => $getKategori,
            ]);
        }else{
            return $this->redirect(Url::to(['login/index']));
        }
    }

    public function getCategoryName($param) {
        switch ($param) {
            case '1':
                return 'Administrator';
            break;
            case '2':
                return 'Moderator';
            break;
            case '3':
                return 'Kepala Daerah';
            break;
            case '4':
                return 'Sesuai Kategori';
            break;
        }
    }
}
