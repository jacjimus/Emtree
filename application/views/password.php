<?php $assessment_css = $this->config->item('assessment')?>
    <link rel="stylesheet" href="<?php echo $assessment_css ?>" />
    <style>
        .text{ width: 250px; padding: 3px; border: 1px solid #cccccc; -moz-border-radius: 5px; color:#333; border-radius: 5px;}
    </style>
    <?php $this->load->view('fancybox_scripts'); ?>
    <body>
        <div id="">
           
            <center>
                <h3>Change Password</h3>
                
                
                <center>
                       
                    <table cellpadding="6px">
                        <?php echo form_open("dashboard/confirm/" . $this->session->userdata('user_id')); ?>
                          <tr>
                            <td style="text-align: left">Old Password:</td>
                            <td style="text-align: left"><?php echo form_password(array("name" => "oldpass", "class" => "text",'required'=>true)); ?></td>
                        </tr>
                        
                        <tr>
                            <td style="text-align: left" width='150px'>New Password: </td>
                            <td style="text-align: left"><?php echo form_password(array("name" => "newpass", "class" => "text",'required'=>true)); ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: left">Confirm New Password: </td>
                            <td style="text-align: left"><?php echo form_password(array("name" => "confpass", "class" => "text",'required'=>true)); ?></td>
                        </tr>
                      
                        <tr>
                            <td style="text-align: left"> </td>
                            <td style="text-align: left"><?php echo form_submit("Save","Save"); ?></td>
                        </tr>
                        <?php form_close(); ?>
                    </table>

                </center>
                <div style="clear: both"></div>
                <br />

        </div>
        
     
