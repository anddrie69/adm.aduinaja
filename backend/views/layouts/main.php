<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use  yii\web\Session;

AppAsset::register($this);
$session = Yii::$app->session;
$id = $session->get('id');
$nik = $session->get('nik');
$nama = $session->get('nama');
$user_level = $session->get('user_level');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>

<?php if($nama != null){ ?>
    <body>
    <?php $this->beginBody() ?>
        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">SB Admin</a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    <li class="dropdown">
                        <a href="<?php echo Url::to(['user/profile', 'id' => $id]); ?>"><?php echo $nama; ?></a>
                        <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $nama; ?> <b class="caret"></b></a> -->
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li class="active">
                            <a href="/"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                        </li>
                        <?php if($user_level == '1'){ ?>
                        <li>
                            <a href="<?php echo Url::to(['kategori/index']); ?>"><i class="fa fa-fw fa-files-o"></i> Kategori Aduan</a>
                        </li>
                        <?php } ?>
                        <li>
                            <a href="<?php echo Url::to(['aduan/index']); ?>"><i class="fa fa-fw fa-files-o"></i> Aduan</a>
                        </li>
                        <?php if($user_level == '1' || $user_level == '3'){ ?>
                        <li>
                            <a href="<?php echo Url::to(['member/index']); ?>"><i class="fa fa-fw fa-files-o"></i> Member</a>
                        </li>
                        <?php } ?>
                        <?php if($user_level == '1'){ ?>
                            <li>
                                <a href="<?php echo Url::to(['user/index']); ?>"><i class="fa fa-fw fa-files-o"></i> User</a>
                            </li>
                            <!-- <li>
                                <a href="<?php //echo Url::to(['site/setting']); ?>"><i class="fa fa-fw fa-file"></i>Setting</a>
                            </li> -->
                        <?php } ?>
                        <li>
                            <a href="<?php echo Url::to(['site/logout']); ?>"><i class="fa fa-fw fa-arrow-up"></i> Logout</a>
                        </li>
                        <!-- <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> User <i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="demo" class="collapse">
                                <li>
                                    <a href="#">Daftar User</a>
                                </li>
                                <li>
                                    <a href="#">Tambahkan User</a>
                                </li>
                            </ul>
                        </li> -->
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>

            <div id="page-wrapper">

                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= $content ?>

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Morris Charts JavaScript -->
        <script src="js/plugins/morris/raphael.min.js"></script>
        <script src="js/plugins/morris/morris.min.js"></script>
        <script src="js/plugins/morris/morris-data.js"></script>
    <?php $this->endBody() ?>
    </body>
<?php }else{ ?>
    <body style="background: #d2d6de none repeat scroll 0 0;">
        <?php $this->beginBody() ?>
            <?php echo $content; ?>
            <!-- jQuery -->
            <script src="js/jquery.js"></script>

            <!-- Bootstrap Core JavaScript -->
            <script src="js/bootstrap.min.js"></script>

            <!-- Morris Charts JavaScript -->
            <script src="js/plugins/morris/raphael.min.js"></script>
            <script src="js/plugins/morris/morris.min.js"></script>
            <script src="js/plugins/morris/morris-data.js"></script>
        <?php $this->endBody() ?>
    </body>
<?php } ?>

</html>
<?php $this->endPage() ?>