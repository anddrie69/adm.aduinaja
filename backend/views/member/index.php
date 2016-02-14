<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'List Member';
?>
<div class="container-fluid">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    List Member
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="/">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> List Member
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
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Email</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no=1;
                                foreach ($data as $key => $value) {
                                    echo '<tr>
                                        <td>'.$no.'</td>
                                        <td><a href="'.$url = Url::to(['member/detail', 'id' => $value['id']]).'">'.$value['nama'].'</a></td>
                                        <td>'.$value['nik'].'</td>
                                        <td>'.$value['email'].'</td>
                                        <td>'.$value['jenis_kelamin'].'</td>
                                        <td>'.$value['alamat'].'</td>
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
