<?php
namespace app\models;

use Yii;
use yii\base\Model;

class ModelAnalytics extends Model
{


    public function getCount($table, $where = ''){
    
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('
            SELECT COUNT(*) as count FROM '.$table.$where);

        $result = $command->queryOne();
        return $result;
    }

    public function getCountAduanCategory($id, $and = ''){

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('
            SELECT COUNT(*) as count FROM t_aduan WHERE category="'.$id.'"'.$and);

        $result = $command->queryOne();
        return $result;
    }

    public function getCountAduanStatus($status, $and = ''){

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('
            SELECT COUNT(*) as count FROM t_aduan WHERE status="'.$status.'"'.$and);

        $result = $command->queryOne();
        return $result;
    }

    public function getCountAduanKecamatan($kecamatan){

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('
            SELECT COUNT(*) as count FROM t_aduan WHERE kecamatan="'.$kecamatan.'"');

        $result = $command->queryOne();
        return $result;
    }

    
} 