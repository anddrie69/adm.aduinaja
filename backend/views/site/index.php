<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use  yii\web\Session;

$session = Yii::$app->session;
$user_level = $session->get('user_level');

$this->title = 'Dashboard';
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

                // ================= Chart 3 ========================= //
                var data = google.visualization.arrayToDataTable([
                ['Kecamatan', 'Jumlah'],
                <?php 
                    foreach ($count_kec as $key => $value) { 
                        echo '["'.$value['kec'].'",  '.$value['count'].'],';
                    }
                ?>
                ]);

                var options = {
                title : 'Jumlah aduan dari setiap kecamatan',
                vAxis: {title: 'Jumlah'},
                hAxis: {title: 'Kecamatan'},
                seriesType: 'bars',
                series: {5: {type: 'line'}}
                };

                var chart = new google.visualization.ComboChart(document.getElementById('kecamatan_aduan'));
                chart.draw(data, options);
            }

        </script>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <b>Aduinaja</b>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <!-- <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Like SB Admin?</strong> Try out <a href="http://startbootstrap.com/template-overviews/sb-admin-2" class="alert-link">SB Admin 2</a> for additional features!
                        </div>
                    </div>
                </div> -->
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-files-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $aduan['count']; ?></div>
                                        <div>Laporan</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo Url::to(['aduan/index']); ?>">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php if($user_level == '1'){ ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-users fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo $member['count']; ?></div>
                                            <div>Member</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?php echo Url::to(['member/index']); ?>">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-user fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo $user['count']; ?></div>
                                            <div>User</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?php echo Url::to(['user/index']); ?>">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- /.row -->
                <?php if($user_level != '4'){ ?>
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
                <?php } ?>
                <?php if($user_level == '1' || $user_level == '2' || $user_level == '3'){ ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Aduan Sesuai Kecamatan</h3>
                                </div>
                                <div class="panel-body">
                                    <div id="kecamatan_aduan" style="width: 100%; height: 400px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
