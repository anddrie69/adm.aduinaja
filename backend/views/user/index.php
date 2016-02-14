<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
use yii\helpers\Html;
use yii\helpers\Url;
use backend\components\helper\FunctionHelper;

$this->title = 'List User';
?>
<div class="container-fluid">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    List User
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="/">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> List User
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <a href="<?php echo Url::to(['user/addnew']); ?>" class="btn btn-primary" style="margin-bottom: 10px;">Add User</a>
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
                                <th>Name</th>
                                <th>Username</th>
                                <th>User Level</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no=1;
                                $function = new FunctionHelper();
                                foreach ($data as $key => $value) {
                                    echo '<tr>
                                        <td>'.$no.'</td>
                                        <td><a href="'.$url = Url::to(['user/edit', 'id' => $value['id']]).'">'.$value['nama'].'</a></td>
                                        <td>'.$value['username'].'</td>
                                        <td>'.$function->UserLevel($value['user_level']).'</td>
                                        <td><a href="'.$url = Url::to(['user/delete', 'id' => $value['id']]).'">Delete</a></td>
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
