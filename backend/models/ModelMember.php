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

    public function AddNewMember(){
        date_default_timezone_set("Asia/Jakarta");
        $id = substr(md5(date("Y-m-d H:i:s")), 10,25);
        $db = Yii::$app->db;
        $sql = $db
                ->createCommand()
                ->insert('t_member', [
                    'id' => $id,
                    'tanggal' => date("Y-m-d H:i:s"),
                    'nama' => $this->nama,
                    'email' => $this->email,
                    'status' => '1'
                    ])
                ->execute();

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

    public function deleteMember($id){

        $db = Yii::$app->db;
        $sql = $db
            ->createCommand()
            ->delete('t_member', ['id' => $id])
            ->execute();
    }

    public function updateMember($id){

        $connection = Yii::$app->getDb();
        $command =$connection->createCommand()
            ->update('t_member', 
                    ['email' => $this->email,
                    'jenis_kelamin' => $this->jenis_kelamin,
                    'alamat' => $this->alamat,
                    'pekerjaan' => $this->pekerjaan,
                    ],
                'id="'.$id.'"')
            ->execute();
    }

    public function updateNikMember($id){

        $connection = Yii::$app->getDb();
        $command =$connection->createCommand()
            ->update('t_member', 
                    ['nama' => $this->nama,
                    'nik' => $this->nik,
                    ],
                'id="'.$id.'"')
            ->execute();
    }

    public function generatePassword($pass){
        return substr(md5($pass), 5,20);
    }
} 