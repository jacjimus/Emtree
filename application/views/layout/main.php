<?php
$css = $this->config->item('css');        
$js = $this->config->item('js');        
    $btsp = $this->config->item('bootstrap');        
    $images= $this->config->item('images');  
    $assets= $this->config->item('assets');  
    $fancybox =  $this->config->item('fancybox');  
    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Emtree360:: <?php echo $this->uri->segment(1)?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?=$btsp?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?=$assets?>custom.css" rel="stylesheet">
    <link href="<?=$assets?>fonts.css" rel="stylesheet">
    <link href="<?=$assets?>landing.css" rel="stylesheet">
    <link href="<?=$css?>jquery-ui-1.10.2.custom.css" rel="stylesheet"> 
    
    <link rel="stylesheet" href="<?php echo $css; ?>font-awesome-4.3.0/css/font-awesome.css" />
    
        
     <link rel="shortcut icon" href="<?php echo $img_path ?>/favico.ico" type="image/x-icon" />
  <script src="<?php echo $js ?>simple-slider.js"></script>

  
    <script src="<?=$btsp?>js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <link href="<?=$css?>rangeslider.css" rel="stylesheet"> 
  </head>

  <body>
 <?php  
            $main_title = '';
            
            if($this->uri->segment(1) == 'dashboard'){
                $main_title = 'Dashboard'; 
            }
            
            else if($this->uri->segment(2) == 'employabilitree'){
                
                $main_title = 'employabilitree';
            }
           
            
            else if($this->uri->segment(2) == 'createaccount'){
                $main_title = 'Create Account';
            }
            
            else if($this->uri->segment(2) == 'index'){
                $main_title = 'Skill Assessment Test';
            }         
            else if($this->uri->segment(2) == 'ask'){
                $main_title = 'ask';
            }         
            else{
                $main_title = 'assessment';
            }
          
            ?>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand logo-name" href="#">Emtree360<sup class="sup">TM</sup></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
             <li class= "<?php echo $main_title=='Dashboard'?"active":"" ?>"><?php echo anchor("dashboard", "Dashboard" ) ?></li>
              <li class= "<?php echo $main_title=='employabilitree'?"active":"" ?>"><?php echo anchor("home/employabilitree", "Employabilitree") ?></li>
              <li  class= "<?php echo $main_title=='assessment'?"active":"" ?>" ><?php echo anchor("home/assessment", "Assessment" ) ?></li>
              <li class= "<?php echo $main_title=='ask'?"active":"" ?>"><?php echo anchor("home/ask", "Ask") ?></li>
           </ul>
          
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  Logged as: <?php echo $this->session->userdata('first_name') . "  " .$this->session->userdata('username'); ?> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#"><?php echo $this->session->userdata('username'); ?>'s  Profile</a></li>
                <li><a href="#">Change Password</a></li>
                <li class="divider"></li>
                <li><?php echo anchor('home/logout', "<img src='$images/logout.gif' title='Logout'   width ='20px '/> Logout"); ?></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <!-- Begin page content -->
    <div class="container">
        <div class="row">
            <div class="col-md-2 logo-holder">
                <img src="<?=$images?>/logo.png" alt="logo" class="img-responsive" />
            </div>
            <div class="col-md-10">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 content-wrapper">
                            <!--Start BreadCrumbs-->
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-12">
                                    <?php echo $breadcrumb ?>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12 sub-header">
                                    <div class="col-md-10">
                                        <?=$title?>
                                    </div>
                                    <div class="col-md-2">
                                        <h2> <?php
                                        if($main_title == "Dashboard"):
                                            $this->load->helper('html');
                                            echo nbs(80) . anchor("assessment/report", "<button class='btn' >Export full report</button>");
                                        endif;
                                                    ?> </h2>
                                    </div> 
                                </div> 
                                </div>
                                <div class="col-md-12">
                                    <?php $this->load->view($page) ?>
                                    
                                </div>
                            </div>
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


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
      <script src="<?=$js?>jquery-2.1.3.min.js"></script> 
    <script src="<?=$btsp?>js/bootstrap.min.js"></script>
      <script src="<?=$js?>rangeslider.min.js"></script> 
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?=$btsp?>js/ie10-viewport-bug-workaround.js"></script>
    

 <!-- Add jQuery library -->


<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="<?php echo $fancybox; ?>/lib/jquery.mousewheel-3.0.6.pack.js"></script>

<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="<?php echo $fancybox; ?>/source/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $fancybox; ?>/source/jquery.fancybox.css?v=2.1.4" media="screen" />

<!-- Add Button helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="<?php echo $fancybox; ?>/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
<script type="text/javascript" src="<?php echo $fancybox; ?>/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

<!-- Add Thumbnail helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="<?php echo $fancybox; ?>/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
<script type="text/javascript" src="<?php echo $fancybox; ?>/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<!-- Add Media helper (this is optional) -->
<script type="text/javascript" src="<?php echo $fancybox; ?>/source/helpers/jquery.fancybox-media.js?v=1.0.5"></script>


<script type="text/javascript">
    
$(document).ready(function() {

        $('.fancybox').fancybox({
            maxWidth: 1000,
            maxHeight: 600,
            //fitToView: false,
            width: '80%',
            //height: '70%',
            //autoSize: false,
           //closeClick: false,
           // openEffect : 'none',
            //closeEffect: 'none'
        });

    $('input[type="range"]').rangeslider({

    // Feature detection the default is `true`.
    // Set this to `false` if you want to use
    // the polyfill also in Browsers which support
    // the native <input type="range"> element.
    polyfill: true,

    // Default CSS classes
    rangeClass: 'rangeslider',
    fillClass: 'rangeslider__fill',
    handleClass: 'rangeslider__handle',

    // Callback function
    onInit: function() {},

    // Callback function
    onSlide: function(position, value) {},

    // Callback function
    onSlideEnd: function(position, value) {}
});
   
        });
        

 
    </script>
  </body>
</html>
