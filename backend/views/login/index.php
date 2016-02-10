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

    <div class="login-box">
        <div class="login-logo">
            <a href="/"><b>Aduin</b>Aja</a>
        </div>
        <div class="login-box-body">
            <?php echo $warning; ?>
            <?php if($warning == ''){ ?>
                <p class="login-box-msg">Silakan masukkan username dan password anda.</p>
            <?php } ?>
            <?php $form = ActiveForm::begin(); ?>
                <div class="form-group has-feedback">
                    <input type="text" name="ModelLogin[username]" id="modellogin-username" class="form-control" placeholder="Username" required autofocus>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="ModelLogin[password]" id="modellogin-password" class="form-control" placeholder="Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Login">
                    </div>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
