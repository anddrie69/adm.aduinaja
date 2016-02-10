<?php
namespace app\models;

use Yii;
use yii\base\Model;

class ModelAnalytics extends Model
{

    // public function getUser(){
    
    //     $connection = Yii::$app->getDb();
    //     $command = $connection->createCommand('
    //         SELECT * FROM t_user');

    //     $result = $command->queryAll();
    //     return $result;
    // }

    public function getCount($table){
    
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('
            SELECT COUNT(*) as count FROM '.$table);

        $result = $command->queryOne();
        return $result;
    }

    public function getCountAduanCategory($id){

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('
            SELECT COUNT(*) as count FROM t_aduan WHERE category="'.$id.'"');

        $result = $command->queryOne();
        return $result;
    }

    public function getCountAduanStatus($status){

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('
            SELECT COUNT(*) as count FROM t_aduan WHERE status="'.$status.'"');

        $result = $command->queryOne();
        return $result;
    }

    
} 