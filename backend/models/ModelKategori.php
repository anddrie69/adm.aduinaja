<?php
namespace app\models;

use Yii;
use yii\base\Model;

class ModelKategori extends Model
{
    public $nama;
    public $deskripsi;

    public function rules()
    {
        return [
            [['nama','deskripsi'], 'required']
        ];
    }

    public function AddNewKategori(){
        date_default_timezone_set("Asia/Jakarta");
        $db = Yii::$app->db;

        $slug = $this->cekSlug($this->nama, 't_kategori');
        
        $sql = $db
                ->createCommand()
                ->insert('t_kategori', [
                    'nama' => $this->nama,
                    'slug' => $slug,
                    'deskripsi' => $this->deskripsi,
                    'status' => '1',
                    ])
                ->execute();

    }

    public function getKategori(){
    
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('
            SELECT * FROM t_kategori');

        $result = $command->queryAll();
        return $result;
    }

    public function getSingleKategori($id){
    
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('
            SELECT * FROM t_kategori WHERE id='.$id);

        $result = $command->queryOne();
        return $result;
    }

    public function deleteKategori($id){

        $db = Yii::$app->db;
        $sql = $db
            ->createCommand()
            ->delete('t_kategori', ['id' => $id])
            ->execute();
    }

    public function updateKategori($id){

        $connection = Yii::$app->getDb();

        $slug = $this->cekSlug($this->nama, 't_kategori');
        $command =$connection->createCommand()
            ->update('t_kategori', 
                    ['nama' => $this->nama,
                    'slug' => $slug,
                    'deskripsi' => $this->deskripsi],
                    'id='.$id)
            ->execute();
    }

    private function cekSlug($name, $table){

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('SELECT COUNT('.$table.'.id) as count_id FROM '.$table.' WHERE slug="'.$name.'"');

        $result = $command->queryOne();
        if ($result != false) {
            $countSlug = $result['count_id'];
        }else{
            $countSlug = '0';
        }

        $slugs = strtolower(str_replace(' ', '-', $name));
        if ( $countSlug > 0 ) {
            $slug = $slugs . '-' . ($countSlug+1);
        } else {
            $slug = $slugs;
        }
        return $slug;
    }
} 