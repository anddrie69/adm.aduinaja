<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Edit User';
?>
<div class="container-fluid">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Edit User
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="/">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Edit User
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <?php $form = ActiveForm::begin(); ?>
            <?php echo $warning; ?>
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">NIK</h3>
                        </div>
                        <div class="panel-body">
                            <input type="text" class="form-control" value="<?php echo $data['nik']; ?>" name="ModelUser[nik]" id="modeluser-nik" placeholder="Masukkan NIK">
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Nama</h3>
                        </div>
                        <div class="panel-body">
                            <input type="hidden" name="ModelUser[nama]" value="<?php echo $data['nama']; ?>">
                            <input type="text" class="form-control" value="<?php echo $data['nama']; ?>" placeholder="Nama" DISABLED>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Username</h3>
                        </div>
                        <div class="panel-body">
                            <input type="text" class="form-control" value="<?php echo $data['username']; ?>" name="ModelUser[username]" id="modeluser-username" placeholder="Masukkan Username">
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
                            <input type="email" class="form-control" value="<?php echo $data['email']; ?>" name="ModelUser[email]" id="modeluser-email" placeholder="Masukkan Email">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Action</h3>
                        </div>
                        <div class="panel-body">
                            <input type="submit" class="btn btn-primary" value="Update">
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">User Level</h3>
                        </div>
                        <div class="panel-body">
                            <select class="form-control" name="ModelUser[user_level]" id="modeluser-user_level">
                                <option>Pilih User Level</option>
                                <?php
                                    switch ($data['user_level']) {
                                        case '1':
                                            $selected1 = 'selected="selected"';
                                            $selected2 = '';
                                            $selected3 = '';
                                            $selected4 = '';
                                            $selected5 = '';
                                        break;
                                        case '2':
                                            $selected1 = '';
                                            $selected2 = 'selected="selected"';
                                            $selected3 = '';
                                            $selected4 = '';
                                            $selected5 = '';
                                        break;
                                        case '3':
                                            $selected1 = '';
                                            $selected2 = '';
                                            $selected3 = 'selected="selected"';
                                            $selected4 = '';
                                            $selected5 = '';
                                        break;
                                        case '4':
                                            $selected1 = '';
                                            $selected2 = '';
                                            $selected3 = '';
                                            $selected4 = 'selected="selected"';
                                            $selected5 = '';
                                        break;
                                        case '5':
                                            $selected1 = '';
                                            $selected2 = '';
                                            $selected3 = '';
                                            $selected4 = '';
                                            $selected5 = 'selected="selected"';
                                        break;
                                        
                                    }
                                ?>
                                <option value="1" <?php echo $selected1; ?>>Administrator</option>
                                <option value="2" <?php echo $selected2; ?>>Moderator</option>
                                <option value="3" <?php echo $selected3; ?>>Kepala Daerah</option>
                                <option value="4" <?php echo $selected4; ?>>Sesuai Kategori</option>
                                <option value="5" <?php echo $selected5; ?>>Sesuai Kecamatan</option>
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
                                        if ($data['category'] == $value['id']) {
                                            $selected = 'selected="selected"';
                                        }else{
                                            $selected = '';
                                        }
                                        echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['nama'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Kecamatan</h3>
                        </div>
                        <div class="panel-body">
                            <select class="form-control" name="ModelUser[kecamatan]" id="modeluser-kecamatan">
                                <option value="0">Pilih Kecamatan</option>
                                <?php
                                    foreach ($getKecamatan as $key => $value) {
                                        echo '<option value="'.$value.'">'.$value.'</option>';
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
