<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Login | Aduin Aja Administrator';
?>
<div class="container" style="margin-top:10%;">
  <div class="row">
    <div class="col-lg-4">
        </div>
    <div class="col-lg-4">
        <center><h2>Login Administrator</h2></center>
        <?php $form = ActiveForm::begin(); ?>
            <?php echo $warning; ?>
            <label for="nik" class="sr-only">Username</label>
            <input type="text" name="ModelLogin[username]" id="modellogin-username" class="form-control" placeholder="Username" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="ModelLogin[password]" id="modellogin-password" class="form-control" placeholder="Password" required>
            <input class="btn btn-lg btn-primary btn-block" type="submit" value="Login">
        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-lg-4"></div>
  </div>
</div> <!-- /container -->
