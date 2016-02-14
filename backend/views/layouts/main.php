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
use backend\components\helper\FunctionHelper;

AppAsset::register($this);
$session = Yii::$app->session;
$id = $session->get('id');
$nik = $session->get('nik');
$nama = $session->get('nama');
$user_level = $session->get('user_level');


$function = new FunctionHelper();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <!-- jQuery -->
    <script src="<?php echo Url::base(); ?>/statics/js/jquery.js"></script>
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
                    <a class="navbar-brand" href="/">Aduin<b>Aja</b></a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    <li class="dropdown">
                        <!-- <a href="<?php //echo Url::to(['user/profile', 'id' => $id]); ?>"><?php //echo $nama; ?></a> -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $nama; ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <!-- <li>
                                <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                            </li> -->
                            <li>
                                <a href="#"><i class="fa fa-fw fa-user"></i>Anda Seorang <?php echo $function->UserLevel($user_level); ?></a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo Url::to(['site/logout']); ?>"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
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
                        <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#demo1"><i class="fa fa-fw fa-files-o"></i> Aduan <i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="demo1" class="collapse">
                                <li>
                                    <a href="<?php echo Url::to(['aduan/index']); ?>">Daftar Aduan</a>
                                </li>
                                <li>
                                    <a href="<?php echo Url::to(['aduan/addnew']); ?>">Tambahkan Aduan</a>
                                </li>
                                <?php if($user_level == '1'){ ?>
                                    <li>
                                        <a href="<?php echo Url::to(['kategori/index']); ?>">Kategori Aduan</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <?php if($user_level == '1' || $user_level == '3'){ ?>
                        <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#demo2"><i class="fa fa-fw fa-files-o"></i> Member <i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="demo2" class="collapse">
                                <li>
                                    <a href="<?php echo Url::to(['member/index']); ?>">Daftar Member</a>
                                </li>
                                <!-- <li>
                                    <a href="<?php //echo Url::to(['member/addnew']); ?>">Tambahkan Member</a>
                                </li> -->
                            </ul>
                        </li>
                        <?php } ?>
                        <?php if($user_level == '1'){ ?>
                            <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#demo3"><i class="fa fa-fw fa-files-o"></i> User <i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="demo3" class="collapse">
                                <li>
                                    <a href="<?php echo Url::to(['user/index']); ?>">Daftar User</a>
                                </li>
                                <li>
                                    <a href="<?php echo Url::to(['user/addnew']); ?>">Tambahkan User</a>
                                </li>
                            </ul>
                        </li>
                            <!-- <li>
                                <a href="<?php //echo Url::to(['site/setting']); ?>"><i class="fa fa-fw fa-file"></i>Setting</a>
                            </li> -->
                        <?php } ?>
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

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo Url::base(); ?>/statics/js/bootstrap.min.js"></script>

    <?php $this->endBody() ?>
    </body>
<?php }else{ ?>
    <body style="background: #d2d6de none repeat scroll 0 0;">
        <?php $this->beginBody() ?>
            <?php echo $content; ?>
            <!-- jQuery -->
            <script src="<?php echo Url::base(); ?>/statics/js/jquery.js"></script>

            <!-- Bootstrap Core JavaScript -->
            <script src="<?php echo Url::base(); ?>/statics/js/bootstrap.min.js"></script>
        <?php $this->endBody() ?>
    </body>
<?php } ?>

</html>
<?php $this->endPage() ?>