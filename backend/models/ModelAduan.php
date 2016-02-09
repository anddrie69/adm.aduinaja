<?php
namespace app\models;

use Yii;
use yii\base\Model;

class ModelAduan extends Model
{
    public $member;
    public $judul;
    public $deskripsi;
    public $category;
    public $img;

    public function rules()
    {
        return [
            [['member', 'judul', 'deskripsi', 'category', 'img'], 'required'],
        ];
    }

    public function AddNewAduan(){
        date_default_timezone_set("Asia/Jakarta");
        $id = 'aduan-'.$this->member.'-'.substr(md5(date("Y-m-d H:i:s")), 10,20);
        $db = Yii::$app->db;
        $sql = $db
                ->createCommand()
                ->insert('t_aduan', [
                    'id' => $id,
                    'tanggal' => date("Y-m-d H:i:s"),
                    'member' => $this->member,
                    'judul' => $this->judul,
                    'deskripsi' => $this->deskripsi,
                    'category' => $this->category,
                    'img' => $this->img,
                    'status' => '1'
                    ])
                ->execute();

    }

    public function getAduan(){
    
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('
            SELECT aduan.*, aduan.id as id_aduan, aduan.tanggal as tanggal_aduan, 
            member.nama as nama_member, member.foto,
            category.nama as nama_category 
            FROM t_aduan as aduan
            INNER JOIN t_member as member ON aduan.member = member.id
            INNER JOIN t_kategori as category ON aduan.category = category.id
            ORDER BY aduan.tanggal DESC');

        $result = $command->queryAll();
        return $result;
    }

    public function getSingleAduan($id){
    
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('
            SELECT *, aduan.id as id_aduan, aduan.tanggal as tanggal_aduan, member.nama as nama_member, category.nama as nama_category 
            FROM t_aduan as aduan
            INNER JOIN t_member as member ON aduan.member = member.id
            INNER JOIN t_kategori as category ON aduan.category = category.id
            WHERE aduan.id="'.$id.'"');

        $result = $command->queryOne();
        return $result;
    }

    public function deleteAduan($id){

        // Delete aduan
        $db = Yii::$app->db;
        $sql = $db
            ->createCommand()
            ->delete('t_aduan', ['id' => $id])
            ->execute();

        // Delete vote
        $db = Yii::$app->db;
        $sql = $db
            ->createCommand()
            ->delete('t_vote', ['aduan' => $id])
            ->execute();

        // Delete comment
        $db = Yii::$app->db;
        $sql = $db
            ->createCommand()
            ->delete('t_comment', ['aduan' => $id])
            ->execute();
        return true;
    }

    public function updateAduan($id){

        $connection = Yii::$app->getDb();
        $command =$connection->createCommand()
            ->update('t_aduan', 
                    ['judul' => $this->judul,
                    'deskripsi' => $this->deskripsi,
                    'category' => $this->category,
                    'img' => $this->img,
                    ],
                'id="'.$id.'"')
            ->execute();
    }

    public function generatePassword($pass){
        return substr(md5($pass), 5,20);
    }
} 