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
use app\models\ModelVote;

/**
 * Site controller
 */
class ApiController extends Controller
{

    public function actionRegister(){

        $model = new ModelMember();
        $request = Yii::$app->request;
        $data = $model->AddNewMember($request->get('id_fb'), $request->get('nama'), $request->get('email'));
        header('Content-Type: application/json');
        if ($data == true) {
            // Sukses
            echo json_encode(array('status' => '1'));
        }else{
            // Gagal
            echo json_encode(array('status' => '2'));
        } 
        // URL : http://back.end/index.php?r=api/register&id_fb=12&nama=andri&email=andri@gmail.com
    }

    public function actionGetaduan(){

        $model = new ModelAduan();
        $model_vote = new ModelVote();
        $data = $model->getAduan();
        header('Content-Type: application/json');
        if ($data == false) {
            echo json_encode(array('data' => $data, 'status' => '1'));
        }else{
            $arrs = array();
            foreach ($data as $key => $value) {
                $up_vote = $model_vote->getCountVote($value['id_aduan'],'1');
                $down_vote = $model_vote->getCountVote($value['id_aduan'],'2');
                $arrs[] = array(
                        'aduan' => $value,
                        'up_vote' => $up_vote['count_vote'],
                        'down_vote' => $up_vote['count_vote'],
                        'comments' => ''
                    );
            }
            echo json_encode(array('data' => $arrs, 'status' => '2'));
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
        $model = new ModelAduan();
        
        if ($model->load(Yii::$app->request->post())) {
            $model->AddNewUser();
            // sukses
            echo json_encode(array('status' => '1'));
        }else{
            // gagal
            echo json_encode(array('status' => '2'));
        } 

        // URL : http://back.end/index.php?r=api/addnewaduan

    }

    public function actionEditaduan(){
        
    }

    public function actionDeleteaduan(){
        
        $model = new ModelAduan();
        $request = Yii::$app->request;
        $data = $model->deleteAduan($request->get('id'));
        header('Content-Type: application/json');
        if ($data == true) {
            // Berhasil
            echo json_encode(array('status' => '1'));
        }else{
            // Gagal
            echo json_encode(array('status' => '2'));
        }

        // URL : http://back.end/index.php?r=api/deleteaduan&id=111111 
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

    public function actionCeknik(){

        $model = new ModelMember();
        $request = Yii::$app->request;
        $data = $model->cekNik($request->get('id'),$request->get('nik'));
        header('Content-Type: application/json');
        if ($data == true) {
            // Ada
            echo json_encode(array('status' => '1'));
        }else{
            // Tidak ada
            echo json_encode(array('status' => '2'));
        }

        // URL : http://back.end/index.php?r=api/getprofile&nik=21&id=
    }

    public function actionVerifikasinik(){
        
        $request = Yii::$app->request;
        $data = $this->getNIKDetail($request->get('nik'));
        header('Content-Type: application/json');
        if ($data == false) {
            echo json_encode(array('data' => $data, 'status' => '1'));
        }else{
            echo json_encode(array('data' => $data, 'status' => '2'));
            $model = new ModelMember();
            $model->updateNikMember($request->get('id'), $data['nama'],$data['nik'],$data['jenis_kelamin']);
        }

        // URL : http://back.end/index.php?r=api/getprofile&nik=21&id=
    }

    private function getNIKDetail($nikToCheck)
    {
        $url = 'http://data.kpu.go.id/dpt2015.php';
        $params = array(
            'wilayah_id' => 0,
            'page' => '',
            'nik_global'=> $nikToCheck,
            'g-recaptcha-response' => "03AHJ_VusUiJlRMSlv9HN5dwITNNoC8khIPwhCX-PPY9lqR933duajtAO38f_TS1fV8-CCpCanHwavLYzux4TFTWUDhMjv9_xNr9LbOlhEULOYSg3ePadE-90FlIblQPB-VJG84ngP9X-RWlwEHhzRbX5EnahR7OSHWAexwG1FhnxrG5D7WMNxO-aj9zA0ExylYXNaGkv3CEk0w3UpXzpHMMH3A0Xpf0eltPG7VSeJOil4xNyMiNmOhAplOVbznKGD88Vapsbf2I2MrYRpu_aik4u13doLtZzwQtq_MGG7poJc24yUyO-Vy4fXut9JatCnwWpay-5mCeFeQXKAxD-vR8Bx5Sp--ShhGRXz3jN0N1Bl4FrhUddVkbLqEobQ5xwCMkgGVTTIQky9psjyp51OyBz_PE8jUoJKgMDp2wVULSFR3nFhUlUXz6n3s0cbgwQnMZG-0lbykFHhr0n5_aEfyO3y90k6iOh5BwUTl7sN35_n0HokoB98DDowC1Ngie3Rwzeax_iMgfWPifwD36CUGap72JwXw6ltBAOmHAxyrgt0L6y9VXBJmjQIPkDAcbW3Ui42StYVhUPdnbxkB03mpAg9M3-t3WdsmLtXiQxYFL4-0SBGbXN4XkQlLhlvKo53TOT6cRi0eaGkblBu2-_0TlhVswPr6YPQKmmGV_S_IJcvEMuW6sIaYJ90O_TuYgKK7ON_YccBD2X0Y5JhXYiQqN4udO6zGTWaX3JkQEsYRGJ4ibwg4nOS0A3v7XVNcRbO5j3G2pWa7YRDE2CL1sjutrmgfpjSlQkfb2soKxngBTea5VlrhbBAQCEwPaFgNsF7oMyN0NbQw5yxYCkMrfJLVwbLpusYYpXxrL5kepS6ODbovaqq8YbCy5rlRVWZ5zkAqs_uuK_zsYVzfESY9qFA-QsYwZO18iuZj3-THDqLkWI6wPRin5RsCFlAZPdhkwz2QxUaKGyQZX0W",
            'cmd' => 'Cari.'
        );

        $page = $this->callCurlPostOnly($url, $params);
        $noTps = $this->scrape_between($page, "<td style=\"width:70%;\">", "</td>");
        $nik = $this->scrape_between($page, "<span class=\"field\">", "</span>");
        $nama = $this->scrape_between($page, "<span class=\"label\">Nama:</span>\n\t\t<span class=\"field\">", "</span>");
        $jk = $this->scrape_between($page, "<span class=\"label\">Jenis kelamin:</span>\n\t\t\t\t<span class=\"field\">", "</span>");
        $alamat = $this->scrape_between($page, "<span class=\"label\">Alamat:</span>", "</span>");
        $rt = $this->scrape_between($page, "<span class=\"label\">RT:</span>", "</span>");
        $rw = $this->scrape_between($page, "<span class=\"label\">RW:</span>", "</span>");
        $dusun = $this->scrape_between($page, "<span class=\"label\">Dusun:</span>", "</span>");
        $kel = $this->scrape_between($page, "<span class=\"label\">Kelurahan:</span>\n\t\t<span class=\"field\">", "</span>");
        $kec = $this->scrape_between($page, "<span class=\"label\">Kecamatan:</span>\n\t\t<span class=\"field\">", "</span>");
        $kab = $this->scrape_between($page, "<span class=\"label\">Kabupaten/Kota:</span>\n\t\t<span class=\"field\">", "</span>");
        $prov = $this->scrape_between($page, "<span class=\"label\">Provinsi:</span>\n\t\t<span class=\"field\">", "</span>");

        $res = array(
            "comm" => "ok",
            "noTPS" => $noTps,
            "alamat_tps" => "",
            "nik" => $nik,
            "nama" => $nama,
            "jenis_kelamin" => $jk,
            "pro" => $prov,
            "kab" => $kab,
            "kec" => $kec,
            "kel" => $kel
        );

        $response = $res;
        if ($res["comm"] != "ok") {
            $response = array('comm' => 'not ok');
        }

        return $response;
    }

    private function scrape_between($data, $start, $end){
        $data = stristr($data, $start); // Stripping all data from before $start
        $data = substr($data, strlen($start));  // Stripping $start
        $stop = stripos($data, $end);   // Getting the position of the $end of the data to scrape
        $data = substr($data, 0, $stop);    // Stripping all data from after and including the $end of the data to scrape
        return $data;   // Returning the scraped data from the function
    }

    private function callCurlPostOnly($url, $params)
    {
        $user_agent = "Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

        $result=curl_exec ($ch);
        curl_close ($ch);

        return $result;
    }
}
