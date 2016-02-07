<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Category';
?>
<div class="container-fluid">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Category
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="/">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Category
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-6">
                <!-- <h2>Bordered with Striped Rows</h2> -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no=1;
                                foreach ($data as $key => $value) {
                                    echo '<tr>
                                        <td>'.$no.'</td>
                                        <td><a href="'.$url = Url::to(['kategori/edit', 'id' => $value['id']]).'">'.$value['nama'].'</a></td>
                                        <td>'.$value['deskripsi'].'</td>
                                        <td><a href="'.$url = Url::to(['kategori/delete', 'id' => $value['id']]).'">Delete</a></td>
                                    </tr>';
                                    $no++;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6">
                <?php $form = ActiveForm::begin(); ?>
                    <?php
                        if ($edit != '') {
                            $nama = $edit['nama'];
                            $deskripsi = $edit['deskripsi'];
                            $title = 'Edit Category';
                            $label = 'Update';
                            $back = '<a href="'. Url::to(['kategori/index']) .'" class="btn btn-primary">Cancel</a>';
                        }else{
                            $nama = '';
                            $deskripsi = '';
                            $title = 'Add New Category';
                            $label = 'Save';
                            $back = '';
                        }
                    ?>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo $title; ?></h3>
                        </div>
                        <div class="panel-body">
                            <input type="text" class="form-control" name="ModelKategori[nama]" id="modelkategori-nama" placeholder="Masukkan Nama" value="<?php echo $nama; ?>">
                        </div>
                        <div class="panel-body">
                            <textarea class="form-control" name="ModelKategori[deskripsi]" id="modelkategori-deskripsi" placeholder="Masukkan Deskripsi"><?php echo $deskripsi; ?></textarea>
                        </div>
                        <div class="panel-body">
                            <input type="submit" class="btn btn-primary" value="<?php echo $label; ?>">
                            <?php echo $back; ?>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
