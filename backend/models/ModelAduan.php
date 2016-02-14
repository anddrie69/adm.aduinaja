<?php
namespace app\models;

use Yii;
use yii\base\Model;
use  yii\web\Session;

class ModelAduan extends Model
{
    public $id;
    public $member;
    public $judul;
    public $deskripsi;
    public $category;
    public $kecamatan;
    // public $img;
    public $status;

    public function rules()
    {
        return [
            [['id','member', 'judul', 'deskripsi', 'category', 'kecamatan', 'status'], 'required'],
        ];
    }

    public function AddNewAduan($member,$judul,$deskripsi,$category,$kecamatan){

        // $foto = $this->img;
        // $filename = $this->filename;
        // $binary = base64_decode($foto);
        // header('Content-Type: bitmap; charset=utf-8');
        // $file = fopen('backend/web/statics/aduan/'.$filename, 'wb');
        // fwrite($file, $binary);
        // fclose($file);

        date_default_timezone_set("Asia/Jakarta");
        $id = 'aduan-'.$this->member.'-'.substr(md5(date("Y-m-d H:i:s")), 10,20);
        $db = Yii::$app->db;
        $sql = $db
                ->createCommand()
                ->insert('t_aduan', [
                    'id' => $id,
                    'tanggal' => date("Y-m-d H:i:s"),
                    'member' => $member,
                    'judul' => $judul,
                    'deskripsi' => $deskripsi,
                    'category' => $category,
                    'kecamatan' => $kecamatan,
                    'img' => '', //$this->img,
                    'status' => '1'
                    ])
                ->execute();

    }

    public function getAduan(){
        
        $session = Yii::$app->session;
        $user_level = $session->get('user_level');
        $category = $session->get('category');

        if($user_level == '4'){
            $cat = 'WHERE aduan.category="'.$category.'"';
        }else{
            $cat = '';
        }

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('
            SELECT aduan.*, aduan.id as id_aduan, aduan.tanggal as tanggal_aduan, aduan.status as status_aduan,
            member.nama as nama_member, member.foto,
            category.nama as nama_category 
            FROM t_aduan as aduan
            INNER JOIN t_member as member ON aduan.member = member.id
            INNER JOIN t_kategori as category ON aduan.category = category.id
            '.$cat.'
            ORDER BY aduan.tanggal DESC');

        $result = $command->queryAll();
        return $result;
    }

    public function getSingleAduan($id){
    
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('
            SELECT *, aduan.id as id_aduan, aduan.tanggal as tanggal_aduan, aduan.status status_aduan,
            member.nama as nama_member, 
            category.nama as nama_category 
            FROM t_aduan as aduan
            INNER JOIN t_member as member ON aduan.member = member.id
            INNER JOIN t_kategori as category ON aduan.category = category.id
            WHERE aduan.id="'.$id.'"');

        $result = $command->queryOne();
        return $result;
    }

    public function getAduanMember($member){
        
        $session = Yii::$app->session;
        $user_level = $session->get('user_level');
        $category = $session->get('category');

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('
            SELECT aduan.*, aduan.id as id_aduan, aduan.tanggal as tanggal_aduan, aduan.status as status_aduan,
            member.nama as nama_member, member.foto,
            category.nama as nama_category 
            FROM t_aduan as aduan
            INNER JOIN t_member as member ON aduan.member = member.id
            INNER JOIN t_kategori as category ON aduan.category = category.id
            WHERE member.id="'.$member.'"
            ORDER BY aduan.tanggal DESC');

        $result = $command->queryAll();
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

    public function updateStatusAduan(){

        $connection = Yii::$app->getDb();
        $command =$connection->createCommand()
            ->update('t_aduan', 
                    ['status' => $this->status,
                    ],
                'id="'.$this->id.'"')
            ->execute();
    }

    public function generatePassword($pass){
        return substr(md5($pass), 5,20);
    }
} 
