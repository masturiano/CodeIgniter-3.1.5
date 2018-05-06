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
                <div align="left" class="title">Current page: <?=$title?></div>
                <div class="container">
                        <!-- BODY -->
                        <div class="modal-body">
                                <div class="<?=$error_class;?>">
                                        <?=$error_message;?>
                                </div>
                                <div class="panel panel-default">
                                        <div class="panel-heading">
                                                <h3>Welcome</h3>
                                        </div>
                                        <div class="panel-body">
                                                <?php echo $this->session->userdata('fullname'); ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </body>
</html>