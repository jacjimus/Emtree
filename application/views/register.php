<?php
$css = $this->config->item('css');
$js = $this->config->item('js');
$img = $this->config->item('images');
$btsp = $this->config->item('bootstrap');
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>Emtree360::Registration</title>

        <!-- Bootstrap core CSS -->
        <link href="<?= $btsp ?>css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo $css; ?>font-awesome-4.3.0/css/font-awesome.css" />
        <style type="text/css">
            /* CSS used here will be applied after bootstrap.css */

            body { 
                background: url('<?= $img ?>Desert.jpg') no-repeat center center fixed; 
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;

            }
            .panel-heading{background-color: rgb(68,157,68) !important; color: #fff  !important;}
            .panel-default {
                opacity: 1.0;
                margin-top: 5% !important;
            }
            .form-group.last {
                margin-bottom:0px;
            }
            <?php
            if (!$this->agent->is_mobile()) {
                ?>
                .form-group {
                    padding-bottom:30px !important;
                }
            <?php } ?>

        </style>
    </head>
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"> <strong class="">Emtree360<small><sup>TM</sup></small>  Registration</strong>

                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-9"><h3>Create a new account</h3></div>
                        <div class="col-md-3">
                            <a href="<?php echo base_url() ?>" class=""><i class="fa fa-arrow-circle-left"></i>&nbsp;Back to Login </a>
                        </div>
                    </div>

                    <font style="font-style: italic; font-size: 10px; color: red;">You must fill in all the fields.</font>

                    <br />
                    <p>
                        <?php echo $this->session->flashdata('signup'); ?>
                        <?php echo $this->session->flashdata('success');
                        ?>

                    </p>

                    <div  class="<?php
                    if (validation_errors()) {
                        echo 'error';
                    } echo "success"
                    ?>">
                        <?php echo validation_errors(); ?><br />  
                    </div>

                    <?php echo form_open('users/add', array('autocomplete' => 'off', "id" => "register")); ?>

                    <div class="form-group">
                        <label for="access" class="col-md-4 control-label">Access Code:</label>

                        <div class="col-md-8">    
                            <?php echo form_input(array("name" => "access", "class" => "text", 'value' => set_value('access'), "required" => true, "class" => "form-control"), ""); ?>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">Email Address:</label>

                        <div class="col-md-8">
                            <?php echo form_input(array("name" => "email", "class" => "text", 'value' => set_value('email'), "class" => "form-control"), ""); ?>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="firstname" class="col-md-4 control-label">First Name:</label>
                        <div class="col-md-8">
                            <?php echo form_input(array("name" => "firstname", "class" => "text", 'value' => set_value('firstname'), "class" => "form-control"), ""); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-md-4 control-label">Last Name:</label>
                        <div class="col-md-8">
                            <?php echo form_input(array("name" => "lastname", "class" => "text", 'value' => set_value('lastname'), "class" => "form-control")); ?>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="sex" class="col-md-4 control-label">Gender:</label>
                        <div class="col-md-8">
                            <?php
                            echo form_dropdown('sex', array("" => "Select",
                                'Male' => 'Male',
                                'Female' => 'Female')
                                    , set_value('sex'), "class='form-control'")
                            ?> 
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="race" class="col-md-4 control-label">Race:</label>
                        <div class="col-md-8">
                            <?php
                            echo form_dropdown('race', array("" => "Select",
                                'asianafrican' => 'Asian African',
                                'blackafrican' => 'Black African',
                                'coloredafrican' => 'Colored African',
                                'indianafrican' => 'Indian African',
                                'whiteafrican' => 'White African',
                                'other' => 'Other',)
                                    , set_value('race'), "class='form-control'");
                            ?> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-md-4 control-label">Password:</label>
                        <div class="col-md-8">
                            <?php echo form_password(array("name" => "password", "class" => "form-control"), ""); ?>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="confirm_password" class="col-md-4 control-label">Confirm Password:</label>
                        <div class="col-md-8">
                            <?php echo form_password(array("name" => "confirm_password", "class" => "form-control"), ""); ?>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="institution" class="col-md-4 control-label">Institution:</label>
                        <div class="col-md-8">
                            <?php
                            $rows = $this->dropdown->generateDropDown("institutions");
                            foreach ($rows as $row) {
                                $category_array[''] = 'Select';
                                $category_array[$row['InstitutionID']] = $row['Institution'];
                            }

                            $list = $category_array;
                            echo form_dropdown('institution', $list, set_value('institution'), "class='form-control'");
                            ?>   
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="sum_comfirmation" class="col-md-6 control-label">Confirm you are Human ? <?php echo @$num1 ?> + <?php echo @$num2; ?>   = </label>
                        <div class="col-md-6">

                            <input type='text' name='sum_confirmation' value='' class='form-control' style="width: 90px !important; margin-left: 50px;"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="access" class="col-md-4 control-label">Choose your favorite Tree:</label>
                        <div class="col-md-8">
                            <?php
                            $trees = $this->dropdown->generateDropDown("trees");
                            foreach ($trees as $tree) {
                                $trees_array[''] = 'Select';
                                $trees_array[$tree['TreeID']] = $tree['Tree'];
                            }

                            $trees_data = $trees_array;
                            echo form_dropdown('treechoice', $trees_data, set_value('treechoice'), "class='form-control'");
                            ?>   
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-4">

                        </div> 
                        <div class="col-md-8">
                            <?php echo form_submit(array("name" => "Submit", "class" => "btn btn-success"), 'Create Account'); ?></td>
                        </div>
                        <?php form_close(); ?>


                    </div>

                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="text-muted">All rights reserved &copy; Christopher John Beukes</p>
        </div>
    </footer>           



    <script type="text/javascript">
        $(document).ready(function () {

            $('#register').validate({// initialize the plugin
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    access: {
                        required: true,
                        minlength: 7
                    }
                }
            });

        });
    </script>
</body>
</html>
