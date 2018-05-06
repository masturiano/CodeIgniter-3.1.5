<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
        <head>
                <title><?=$title?></title>
                <?php include('includes.php');?>  
                <script>
                        // BOOT GRID
                        // Refer to http://jquery-bootgrid.com/Documentation for methods, events and settings
                        $(function()
                        {
                                function init()
                                {
                                        $("#grid-data").bootgrid({
                                                formatters: {
                                                        "link": function(column, row)
                                                        {
                                                            return "<?php echo base_url('maintenance_controller/users');?>" + column.id + ": " + row.id + "</a>";
                                                        }
                                                },
                                                rowCount: [10, 50, 75, -1]
                                        }).on("selected.rs.jquery.bootgrid", function (e, rows) {
                                                var value = $("#grid-data").bootgrid("getSelectedRows");
                                                if(value.length == 0){
                                                        $('#button_add').attr('disabled','disabled'); 
                                                }
                                                else if(value.length == 1){
                                                        $('#button_add').removeAttr('disabled');
                                                }
                                                else{    
                                                        $('#button_add').attr('disabled','disabled'); 
                                                }                                                    
                                        }).on("deselected.rs.jquery.bootgrid", function (e, rows){
                                                var value = $("#grid-data").bootgrid("getSelectedRows");
                                                if(value.length == 0){
                                                        $('#button_add').attr('disabled','disabled'); 
                                                }
                                                else if(value.length == 1){
                                                        $('#button_add').removeAttr('disabled');
                                                }
                                                else{    
                                                        $('#button_add').attr('disabled','disabled'); 
                                                }       
                                        })  
                                }
                                init();       
                        }); 
                </script>
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
                                <form id="form_login" method="POST" action="login">
                                        <div class="form-group">
                                                <?php 
                                                $js = array('onClick' => 'functionName();');
                                                echo form_input($button_add,'',$js); 
                                                ?>
                                        </div>
                                </form>
                                <table id="grid-data" class="table table-condensed table-hover table-striped"
                                data-selection="true" 
                                data-multi-select="false" 
                                data-row-select="true" 
                                data-keep-selection="true">
                                        <thead>
                                                <tr class="clickable-row"> 
                                                        <!-- data-column-id="sender" data-column-id="received" -->
                                                        <th data-column-id="id" data-type="numeric" data-identifier="true" data-order="asc">User Id</th>
                                                        <th data-column-id="group_name">Group Name</th>
                                                        <th data-column-id="description">Full Name</th>
                                                        <th data-column-id="packaging">User Name</th>
                                                        <th data-column-id="unit_price" data-visible="false">User Pass</th>
                                                        <th data-column-id="no_of_items">User Status</th>
                                                        <th data-column-id="lower_limit">Date Enter</th>
                                                        <th data-column-id="lower_limit">Date Update</th>
                                                        <th data-column-id="lower_limit">Ip Address</th>
                                                        <th data-column-id="lower_limit">Log</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                                <?
                                                foreach($tbl_users_list as $row){
                                                ?>
                                                <tr>
                                                        <td id="<?php echo $row->user_id; ?>"><?php echo $row->user_id; ?></td>
                                                        <td id="<?php echo $row->user_id; ?>"><?php echo $row->group_name; ?></td>
                                                        <td id="<?php echo $row->user_id; ?>"><?php echo $row->full_name; ?></td>
                                                        <td id="<?php echo $row->user_id; ?>"><?php echo $row->user_name; ?></td>
                                                        <td id="<?php echo $row->user_id; ?>"><?php echo $row->user_pass; ?></td>
                                                        <td id="<?php echo $row->user_id; ?>"><?php echo $row->user_stat; ?></td>
                                                        <td id="<?php echo $row->user_id; ?>"><?php echo $row->date_enter; ?></td> 
                                                        <td id="<?php echo $row->user_id; ?>"><?php echo $row->date_update; ?></td> 
                                                        <td id="<?php echo $row->user_id; ?>"><?php echo $row->ip_address ;?></td>
                                                        <td id="<?php echo $row->user_id; ?>"><?php echo $row->log; ?></td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                        </tbody>
                                </table> 
                        </div>
                </div>
        </body>
</html>