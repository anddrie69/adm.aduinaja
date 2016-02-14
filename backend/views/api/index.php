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
        <!-- /.row -->
        <?php //$form = ActiveForm::begin(); ?>
        <form action="http://adm.aduinaja.com/backend/web/index.php?r=api/upload" method="post" enctype="multipart/form-data">
            <div class="row">
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
                            <h3 class="panel-title">Upload</h3>
                        </div>
                        <div class="panel-body">
                            <span class="ui-btn ui-icon-plus ui-btn-icon-left ui-corner-all fileinput-button">
                                <input type="file" style="width:100%" name="foto" size="20" id="file_post_img" multiple data-role="none"/>
                            </span>
                            <br />
                            <div id="foto" style="width:100%;"></div>
                            <input id="fotoname" type="hidden" value="" name="gambar">
                            <span id="loader" style="display:none;">Loading....</span>
                            <?php
                                // if ($gambar != '') {
                                //     echo '<img id="fotoEdit" src="'.base_url().'statics/images/'.$gambar.'" width="100%" />';
                                // }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php //ActiveForm::end(); ?>
    </div>
</div>


<script type="text/javascript">
    $("#file_post_img").change(function(e){
        var file_gmb = $("#file_post_img").prop('files')[0];
        var myfrm = new FormData();
        myfrm.append('foto',file_gmb);
        $.ajax({
            beforeSend:function(){
                $("#loader").show();
            },
            url:"http://adm.aduinaja.com/backend/web/index.php?r=api/upload",
            dataType:'json',
            cache:false,
            contentType: false,
            processData: false,
            data:myfrm,
            type:'post',
            success:function(response){

                $("#foto").append("<img style='width:50%' src='http://adm.aduinaja.com/backend/web/statics/aduan/"+response.imgname+"'>");
                $("#fotoname").val(response.imgname);
            },
            complete:function(data){
                $("#loader").hide();
                $("#fotoEdit").hide();
                
            }
        });
    });
</script>