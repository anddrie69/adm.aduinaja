<?php
namespace app\models;

use Yii;
use yii\base\Model;

class ModelMember extends Model
{
    public $nama;
    public $nik;
    public $email;
    public $jenis_kelamin;
    public $alamat;
    public $pekerjaan;
    public $foto;

    public function rules()
    {
        return [
            [['nama', 'nik', 'email', 'jenis_kelamin', 'alamat', 'pekerjaan', 'foto'], 'required'],
            ['email', 'email'],
        ];
    }

    public function AddNewMember($id_fb, $nama, $email){
        date_default_timezone_set("Asia/Jakarta");
        $id = substr(md5(date("Y-m-d H:i:s")), 10,25);
        $db = Yii::$app->db;
        $sql = $db
                ->createCommand()
                ->insert('t_member', [
                    'id' => $id,
                    'tanggal' => date("Y-m-d H:i:s"),
                    'id_fb' => $id_fb,
                    'nama' => $nama,
                    'email' => $email,
                    'foto' => 'https://graph.facebook.com/'.$id_fb.'/picture?type=normal',
                    'status' => '1'
                    ])
                ->execute();
        return true;

    }

    public function getMember(){
    
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('
            SELECT * FROM t_member');

        $result = $command->queryAll();
        return $result;
    }

    public function getSingleMember($id){
    
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('
            SELECT * FROM t_member WHERE id="'.$id.'"');

        $result = $command->queryOne();
        return $result;
    }

    public function getCekFb($id_fb){
    
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('
            SELECT * FROM t_member WHERE id_fb="'.$id_fb.'"');

        $result = $command->queryOne();
        return $result;
    }

    public function cekNik($id,$nik){
    
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('
            SELECT * FROM t_member WHERE id="'.$id.'" AND nik="'.$nik.'"');

        $result = $command->queryOne();
        return $result;
    }

    public function deleteMember($id){

        $db = Yii::$app->db;
        $sql = $db
            ->createCommand()
            ->delete('t_member', ['id' => $id])
            ->execute();
    }

    public function updateMember($id, $email, $jenis_kelamin, $alamat, $pekerjaan){

        $connection = Yii::$app->getDb();
        $command =$connection->createCommand()
            ->update('t_member', 
                    ['email' => $email,
                    'jenis_kelamin' => $jenis_kelamin,
                    'alamat' => $alamat,
                    'pekerjaan' => $pekerjaan,
                    ],
                'id="'.$id.'"')
            ->execute();
    }

    public function updateNikMember($id,$nama,$nik,$jenis_kelamin){

        $connection = Yii::$app->getDb();
        $command =$connection->createCommand()
            ->update('t_member', 
                    ['nama' => $nama,
                    'nik' => $nik,
                    'jenis_kelamin' => $jenis_kelamin,
                    ],
                'id="'.$id.'"')
            ->execute();
    }

    public function generatePassword($pass){
        return substr(md5($pass), 5,20);
    }
} 