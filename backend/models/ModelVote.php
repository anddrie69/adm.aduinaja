<?php
namespace app\models;

use Yii;
use yii\base\Model;

class ModelVote extends Model
{
    public $member;
    public $aduan;
    public $jenis;

    public function rules()
    {
        return [
            [['member', 'aduan', 'jenis'], 'required'],
        ];
    }

    public function AddNewAduan(){
        date_default_timezone_set("Asia/Jakarta");
        $id = 'vote-'.$this->member.'-'.substr(md5(date("Y-m-d H:i:s")), 5,15);
        $db = Yii::$app->db;
        $sql = $db
                ->createCommand()
                ->insert('t_vote', [
                    'id' => $id,
                    'tanggal' => date("Y-m-d H:i:s"),
                    'member' => $this->member,
                    'aduan' => $this->aduan,
                    'jenis' => $this->jenis,
                    'status' => '1'
                    ])
                ->execute();

    }

    public function getCountVote($aduan, $jenis){
    
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('
            SELECT COUNT(id) as count_vote FROM t_vote WHERE aduan="'.$aduan.'" AND jenis="'.$jenis.'"');

        $result = $command->queryOne();
        return $result;
    }

} 