<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use     yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\components\helper\FunctionHelper;
$function = new FunctionHelper();

$this->title = 'Detail Member';
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
         // ================= Chart 1 ========================= //
        var data = google.visualization.arrayToDataTable([
            ['Nama Kategori', 'Jumlah'],
            <?php 
                foreach ($count_category as $key => $value) {
                    echo '["'.$value['nama'].'",     '.$value['count'].'],';
                }
            ?>
        ]);

        var options = {
            title: 'Jumlah Aduan Sesuai Kategori',
            is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('aduan_kategori'));
        chart.draw(data, options);

        // ================= Chart 2 ========================= //
        var data1 = google.visualization.arrayToDataTable([
            ['Nama Status', 'Jumlah'],
            <?php 
                foreach ($count_status as $keys => $values) {
                    echo '["'.$keys.'",     '.$values.'],';
                }
            ?>
        ]);

        var options1 = {
            title: 'Jumlah Aduan Sesuai Status',
            is3D: true,
        };

        var chart1 = new google.visualization.PieChart(document.getElementById('aduan_status'));
        chart1.draw(data1, options1);
    }
</script>
<div class="container-fluid">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Detail Member
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="/">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Detail Member
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Data Profil Member</h3>
                    </div>
                    <div class="panel-body">
                        <table>
                            <tr>
                                <td>Nama</td>
                                <td> : <?php echo $data['nama']; ?></td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td> : <?php echo $data['nik']; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td> : <?php echo $data['email']; ?></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td> : <?php echo $data['jenis_kelamin']; ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td> : <?php echo $data['alamat']; ?></td>
                            </tr>
                            <tr>
                                <td>Pekerjaan</td>
                                <td> : <?php echo $data['pekerjaan']; ?></td>
                            </tr>
                            <tr>
                                <td>Foto</td>
                                <td> : <img src="<?php echo $data['foto']; ?>" /></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Aduan Sesuai Kategori</h3>
                    </div>
                    <div class="panel-body">
                        <div id="aduan_kategori" style="width: 100%; height: 300px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Aduan Sesuai Status</h3>
                    </div>
                    <div class="panel-body">
                        <div id="aduan_status" style="width: 100%; height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Data Aduan Member</h3>
                    </div>
                    <div class="panel-body">
                        <?php if($data != null){ ?>
                            <table>
                                <?php foreach ($data_aduan as $key => $value) { ?>
                                    <tr>
                                        <td><h2><?php echo $value['judul']; ?></h2></td>
                                    </tr>
                                    <tr>
                                        <td><span><?php echo $value['tanggal_aduan']; ?></span>
                                            <?php 
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
                                            ?>
                                            <span <?php echo $css; ?>><?php echo $function->StatusAduan($value['status_aduan']); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><p><?php echo $value['deskripsi']; ?></p>
                                            <?php if($value['img'] != ''){ ?>
                                                <img src="<?php echo Url::base().'/statics/aduan/'.$value['img']; ?>" width="50%" style="padding:20px;" />
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        <?php
                            }else{
                                echo $data['nama'].' belum pernah memberikan aduan.';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
