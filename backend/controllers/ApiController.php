<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Session;
use yii\helpers\Url;
use app\models\ModelApi;
use app\models\ModelAduan;
use app\models\ModelKategori;
use app\models\ModelMember;

/**
 * Site controller
 */
class ApiController extends Controller
{

    public function actionGetaduan(){

        $model = new ModelAduan();
        $data = $model->getAduan();
        header('Content-Type: application/json');
        if ($data == false) {
            echo json_encode(array('data' => $data, 'status' => '1'));
        }else{
            echo json_encode(array('data' => $data, 'status' => '2'));
        }
        

        // URL : http://back.end/index.php?r=api/getaduan
    }

    public function actionGetsingleaduan(){
        
        $model = new ModelAduan();
        $request = Yii::$app->request;
        $data = $model->getSingleAduan($request->get('id'));
        header('Content-Type: application/json');
        if ($data == false) {
            echo json_encode(array('data' => $data, 'status' => '1'));
        }else{
            echo json_encode(array('data' => $data, 'status' => '2'));
        } 

        // URL : http://back.end/index.php?r=api/getsingleaduan&id=111111 
    }

    public function actionAddnewaduan(){
        
    }

    public function actionEditaduan(){
        
    }

    public function actionDeleteduan(){
        
    }

    public function actionGetkategori(){
        
        $model = new ModelKategori();
        $data = $model->getKategori();
        header('Content-Type: application/json');
        if ($data == false) {
            echo json_encode(array('data' => $data, 'status' => '1'));
        }else{
            echo json_encode(array('data' => $data, 'status' => '2'));
        }

        // URL : http://back.end/index.php?r=api/getkategori
    }

    public function actionGetprofile(){
        
        $model = new ModelMember();
        $request = Yii::$app->request;
        $data = $model->getSingleMember($request->get('id'));
        header('Content-Type: application/json');
        if ($data == false) {
            echo json_encode(array('data' => $data, 'status' => '1'));
        }else{
            echo json_encode(array('data' => $data, 'status' => '2'));
        }

        // URL : http://back.end/index.php?r=api/getprofile&id=21
    }

}
