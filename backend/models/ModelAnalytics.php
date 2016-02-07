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

    
} 