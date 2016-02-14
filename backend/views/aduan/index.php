<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;
use backend\components\helper\FunctionHelper;

$this->title = 'List Aduan';
?>
<div class="container-fluid">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    List Aduan
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="/">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> List Aduan
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <!-- <h2>Bordered with Striped Rows</h2> -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Judul</th>
                                <th>Member</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th>Status Aduan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no=1;
                                $function = new FunctionHelper();
                                foreach ($data as $key => $value) {
                                    switch ($value['status_aduan']) {
                                        case '1':
                                            $css = 'class="btn btn-primary"';
                                        break;
                                        case '2':
                                            $css = 'class="btn btn-success"';
                                        break;
                                        case '3':
                                            $css = 'class="btn btn-danger"';
                                        break;
                                    }
                                    
                                    echo '<tr>
                                        <td>'.$no.'</td>
                                        <td>'.$value['tanggal_aduan'].'</td>
                                        <td><a href="'.$url = Url::to(['aduan/edit', 'id' => $value['id']]).'">'.$value['judul'].'</a></td>
                                        <td>'.$value['nama_member'].'</td>
                                        <td>'.$value['nama_category'].'</td>
                                        <td>'.$value['deskripsi'].'</td>
                                        <td><span '.$css. '>'. $function->StatusAduan($value['status_aduan']) .'</span></td>
                                    </tr>';
                                    $no++;
                                }
                                // var_dump($data);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
