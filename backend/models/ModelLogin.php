<?php
namespace app\models;

use Yii;
use yii\base\Model;
use  yii\web\Session;

class ModelLogin extends Model
{
    public $username;
    public $password;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['email', 'email'],
        ];
    }

    public function LoginUser(){
    
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('
            SELECT * FROM t_user WHERE username="'.$this->username.'" AND password="'.$this->generatePassword($this->password).'"');

        $result = $command->queryOne();
        
        if ($result != null) {
            $session = new Session;
            $session->open();
            $session['username'] = $this->username;
            $session['id'] = $result['id'];
            $session['nik'] = $result['nik'];
            $session['nama'] = $result['nama'];
            $session['user_level'] = $result['user_level'];
        }
        
        return $result;
    }

    public function generatePassword($pass){
        return substr(md5($pass), 5,20);
    }

} 