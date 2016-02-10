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
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Judul</h3>
                        </div>
                        <div class="panel-body">
                            <?php echo $data['judul']; ?>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Nama Member</h3>
                        </div>
                        <div class="panel-body">
                            <?php echo $data['nama_member']; ?>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Deskripsi</h3>
                        </div>
                        <div class="panel-body">
                            <?php echo $data['deskripsi']; ?>
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
                            <h3 class="panel-title">Tanggal</h3>
                        </div>
                        <div class="panel-body">
                            <?php echo $data['tanggal_aduan']; ?>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">User Level</h3>
                        </div>
                        <div class="panel-body">
                            <input type="hidden" value="<?php echo $data['id_aduan']; ?>" name="ModelAduan[id]" id="modeladuan-id">
                            <select class="form-control" name="ModelAduan[status]" id="modeladuan-status">
                                <?php
                                    switch ($data['status_aduan']) {
                                        case '1':
                                            $selected1 = 'selected="selected"';
                                            $selected2 = '';
                                            $selected3 = '';
                                            $selected4 = '';
                                        break;
                                        case '2':
                                            $selected1 = '';
                                            $selected2 = 'selected="selected"';
                                            $selected3 = '';
                                            $selected4 = '';
                                        break;
                                        case '3':
                                            $selected1 = '';
                                            $selected2 = '';
                                            $selected3 = 'selected="selected"';
                                            $selected4 = '';
                                        break;
                                        
                                    }
                                ?>
                                <option value="1" <?php echo $selected1; ?>>Diterima</option>
                                <option value="2" <?php echo $selected2; ?>>Dilaksanakan</option>
                                <option value="3" <?php echo $selected3; ?>>Ditolak</option>
                            </select>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Image</h3>
                        </div>
                            <img src="<?php echo Url::base().'/statics/aduan/'.$data['img']; ?>" width="100%" style="padding:20px;" />
                        </div>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
