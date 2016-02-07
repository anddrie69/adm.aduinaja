<?php
namespace app\models;

use Yii;
use yii\base\Model;

class ModelUser extends Model
{
    public $nik;
    public $nama;
    public $username;
    public $password;
    public $email;
    public $user_level;
    public $category;

    public function rules()
    {
        return [
            [['nik', 'nama', 'username', 'password', 'email', 'user_level', 'category'], 'required'],
            ['email', 'email'],
        ];
    }

    public function AddNewUser(){
        date_default_timezone_set("Asia/Jakarta");
        $id = substr(md5(date("Y-m-d H:i:s")), 5,15);
        $db = Yii::$app->db;
        $sql = $db
                ->createCommand()
                ->insert('t_user', [
                    'id' => $id,
                    'tanggal' => date("Y-m-d H:i:s"),
                    'nik' => $this->nik,
                    'nama' => $this->nama,
                    'username' => $this->username,
                    'password' => $this->generatePassword($this->password),
                    'email' => $this->email,
                    'user_level' => $this->user_level,
                    'category' => $this->category,
                    'status' => '1'
                    ])
                ->execute();

    }

    public function getUser(){
    
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('
            SELECT * FROM t_user');

        $result = $command->queryAll();
        return $result;
    }

    public function getSingleUser($id){
    
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('
            SELECT * FROM t_user WHERE id="'.$id.'"');

        $result = $command->queryOne();
        return $result;
    }

    public function deleteUser($id){

        $db = Yii::$app->db;
        $sql = $db
            ->createCommand()
            ->delete('t_user', ['id' => $id])
            ->execute();
    }

    public function updateUser($id){

        $connection = Yii::$app->getDb();
        $command =$connection->createCommand()
            ->update('t_user', 
                    ['nik' => $this->nik,
                    'nama' => $this->nama,
                    'username' => $this->username,
                    'password' => $this->generatePassword($this->password),
                    'email' => $this->email,
                    'user_level' => $this->user_level,
                    'category' => $this->category,
                    ],
                'id="'.$id.'"')
            ->execute();
    }

    public function generatePassword($pass){
        return substr(md5($pass), 5,20);
    }
} 