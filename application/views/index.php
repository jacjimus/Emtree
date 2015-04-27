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

    <title>Emtree360::Login</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=$btsp?>css/bootstrap.min.css" rel="stylesheet" />
     <link rel="stylesheet" href="<?php echo $css; ?>font-awesome-4.3.0/css/font-awesome.css" />
<style type="text/css">
/* CSS used here will be applied after bootstrap.css */

body { 
 background: url('<?=$img?>Desert.jpg') no-repeat center center fixed; 
 -webkit-background-size: cover;
 -moz-background-size: cover;
 -o-background-size: cover;
 background-size: cover;

}
.panel-heading{background-color: rgb(68,157,68) !important; color: #fff  !important;}
.panel-default {
 opacity: 1.0;
 margin-top: 30% !important;
}
.form-group.last {
 margin-bottom:0px;
}
span , span-2 {
  position: relative; /* Helps curtail overlap */
  border: solid 1px #bbb;
  padding: 3px 5px 5px 25px; /* Adjust as needed */
}
span input , span-2 input{
  border: none;
  width: 80%;
  height: 20px;
}
span:before {
  content: '\f007';
  position: absolute;
  left: 5px;
  font-family: fontAwesome;
  color: #888; /* Your desired color */
}
span-2:before {
  content: '\f023';
  position: absolute;
  left: 5px;
  font-family: fontAwesome;
  color: #888; /* Your desired color */
}


</style>
  </head>
  <div class="container">
    <div class="row">
        <div class="col-md-3  col-md-offset-4" >
                
        </div>
        <div class="col-md-4 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"> <strong class="">Emtree360<small><sup>TM</sup></small>  Login</strong>

                </div>
                <div class="panel-body">
                     <?php
                        echo form_label(
                                        $this->session->flashdata('login'), "",
                                        array(
                                            "for"=>"loginkeeping",
                                            "style" => "color: red; font-size: 11px;"
                                        )
                                    );
                            ?>
                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url() ?>index.php/home/verifyUser">
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                               <span class="input-icon">
                                <input class="" name="username" placeholder="Username" type="text">
                               </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-9">
                                <span-2 class="input-icon">
                                <input class="" id="password" name="password" placeholder="Password" required="" type="password">
                                </span-2>
                                
                           
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <div class="checkbox">
                                <a href="<?php echo base_url() ?>index.php/home/newpassword" class="">Forgot password?</a>
                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group last">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn-block btn-success btn-sm">Sign in</button>
                                </div>
                        </div>
                    </form>
                    <div class="panel-footer">Not Registered? <a href="<?php echo base_url() ?>index.php/users/createaccount" class="">Register here</a>
                </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
  <div class="container">
      <div class="row">
  <footer class="footer">
      <div class="container">
          <p class="text-muted">All rights reserved &copy; Christopher John Beukes</p>
      </div>
    </footer>
  </div>
  </div>