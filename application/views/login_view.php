<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
        <head>
                <title><?=$title?></title>
                <?php include('includes.php');?>  
                <script src="<? echo base_url('includes/js/login_view.js'); ?>"></script>
        </head>
        <body>
                <?php include('menu.php');?>
                <div align="left" style="float: left;" class="title">Current page: <?=$title?></div>
                <div align="right" style="float: right;">
                        <form id="form_language" method="POST" action="login">
                                <?php 
                                $js = array('onChange' => 'changeLanguage();');
                                echo form_dropdown($text_language, $text_language_option, 'select', $js) 
                                ?>
                        </form>
                </div>
                </br></br>
                <div class="container">
                        <!-- BODY -->
                        <div class="modal-body">
                                <div class="<?=$error_class;?>">
                                        <?=$error_message;?>
                                </div>
                                <form id="form_login" method="POST" action="login">
                                        <div id="login-header-top"><p>LOGIN</p></div>
                                        <div class="form-group">
                                                <?php echo form_input($text_username,''); ?>
                                        </div>
                                        <div class="form-group">
                                                <?php echo form_input($text_password,''); ?>
                                        </div>
                                        <div class="form-group">
                                                <?php 
                                                echo form_input($button_submit,''); 
                                                ?>
                                        </div>
                                        <div id="login-header-bottom"></div>
                                </form>
                        </div>
                </div>
        </body>
</html>
<script type="text/javascript">
        function changeLanguage(){
                if($('#text_language').val() == "select"){
                        bootbox.alert("Please select language!", function() {  
                        }); 
                }
                else{
                        $.ajax({
                                url: "<?php echo base_url('account_controller/change_language');?>",
                                type: "POST",
                                data: $('#form_language').serialize(),
                                success: function(){
                                        document.location.reload();
                                }         
                        });  
                }
        }
</script>