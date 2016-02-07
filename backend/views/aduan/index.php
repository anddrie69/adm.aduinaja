<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

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
                                <th>Category</th>
                                <th>Deskripsi</th>
                                <th>Img</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no=1;
                                foreach ($data as $key => $value) {
                                    echo '<tr>
                                        <td>'.$no.'</td>
                                        <td>'.$value['tanggal_aduan'].'</td>
                                        <td>'.$value['judul'].'</td>
                                        <td>'.$value['nama_member'].'</td>
                                        <td>'.$value['nama_category'].'</td>
                                        <td>'.$value['deskripsi'].'</td>
                                        <td>'.$value['img'].'</td>
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
