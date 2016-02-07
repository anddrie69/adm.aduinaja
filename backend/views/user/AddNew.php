<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Add New User';
?>
<div class="container-fluid">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Add New User
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="/">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Add New User
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">NIK</h3>
                        </div>
                        <div class="panel-body">
                            <input type="text" class="form-control" name="ModelUser[nik]" id="modeluser-nik" placeholder="Masukkan NIK">
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Nama</h3>
                        </div>
                        <div class="panel-body">
                            <input type="hidden" name="ModelUser[nama]" value="">
                            <input type="text" class="form-control" placeholder="Nama" DISABLED>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Username</h3>
                        </div>
                        <div class="panel-body">
                            <input type="text" class="form-control" name="ModelUser[username]" id="modeluser-username" placeholder="Masukkan Username">
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Password</h3>
                        </div>
                        <div class="panel-body">
                            <input type="password" class="form-control" name="ModelUser[password]" id="modeluser-password" placeholder="Masukkan Password" REQUIRED>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Email</h3>
                        </div>
                        <div class="panel-body">
                            <input type="email" class="form-control" name="ModelUser[email]" id="modeluser-email" placeholder="Masukkan Email">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Action</h3>
                        </div>
                        <div class="panel-body">
                            <input type="submit" class="btn btn-primary" value="Save">
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">User Level</h3>
                        </div>
                        <div class="panel-body">
                            <select class="form-control" name="ModelUser[user_level]" id="modeluser-user_level">
                                <option>Pilih User Level</option>
                                <option value="1">Administrator</option>
                                <option value="2">Moderator</option>
                                <option value="3">Kepala Daerah</option>
                                <option value="4">Sesuai Kategori</option>
                            </select>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Kategori</h3>
                        </div>
                        <div class="panel-body">
                            <select class="form-control" name="ModelUser[category]" id="modeluser-category">
                                <option value="0">Semua Kategori</option>
                                <?php
                                    foreach ($getKategori as $key => $value) {
                                        echo '<option value="'.$value['id'].'">'.$value['nama'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
