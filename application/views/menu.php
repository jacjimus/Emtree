<?php
$css_path = $this->config->item('base_url') . "/media/css";
$js_path = $this->config->item('base_url') . "/media/js";
$img_path = $this->config->item('base_url') . "/media/images/";
?>
<head><meta name="viewport" content="width=device-width, initial-scale=1"> 

 <!--[if lt IE 8]>
<link rel="stylesheet" type="text/css" href="<?php echo $css_path ?>/css/ie.css" media="screen, projection" />
<![endif]-->
  <link rel="shortcut icon" href="<?php echo $img_path ?>/favico.ico" type="image/x-icon" />
  <script src="<?php echo $js_path ?>/simple-slider.js"></script>

  <link href="<?php echo $css_path ?>/simple-slider.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo $css_path ?>/simple-slider-volume.css" rel="stylesheet" type="text/css" />  
</head>

<style type="text/css">
    @font-face {
        font-family: 'scribbleregular';
        src: url('<?php echo $css_path; ?>/fonts/scribbleregular.eot');
        src: url('<?php echo $css_path; ?>/fonts/scribbleregular.eot?#iefix') format('embedded-opentype'), url('<?php echo $css_path; ?>/fonts/scribbleregular.woff') format('woff'), url('<?php echo $css_path; ?>/fonts/scribbleregular.ttf') format('truetype'), url('<?php echo $css_path; ?>/fonts/scribbleregular.svg#scribbleregular') format('svg');
        font-weight: normal;
        font-style: normal;
    }
    .logo_font{
        font-size: 36px; font-family: 'scribbleregular' !important; padding: 40px; margin-left: 50px; margin-top: 10px;
    }
    .logo_font2{
        font-size: 40px; font-family: 'scribbleregular' !important; float: right; text-align: right;
    }
</style>

<link rel="stylesheet" href="<?php echo $css_path; ?>/bootstrap.css" />

<div id=top_section">
    <?php echo anchor("dashboard", "<img src='$images/logo_inner.png' style='float: left;' width='150px' height = '182px'/>"); ?>
    <div id="statusHolder" style="float: right; text-align: right;">
        <?php
        if($this->session->userdata('username')){
            
        ?>
            Logged: <span style="font-size: 14px; font-weight: bold;">
            <?php 
                
                echo $this->session->userdata('first_name') . "  " .$this->session->userdata('username'); 
            
            ?></span> |  
            <?php 
                echo anchor('home/logout', "<img src='$images/logout.gif' title='Logout'   width ='20px '/>"); 
            }
            ?>
            <br />
            <?php
             //echo anchor('dashboard/changepassword', "change password" ,array("class" => "fancybox fancybox.ajax")); 
            
            ?>
            <div style="clear: both;"></div>
            <?php  
            $main_title = '';
            
            if($this->uri->segment(1) == 'dashboard'){
                $main_title = 'Dashboard'; 
            }
            
            else if($this->uri->segment(2) == 'loadcategory'){
                $category_id = $this->uri->segment(3);
                $main_title = $this->assessments->getCategoryName($category_id);
            }
            
            else if($this->uri->segment(2) == 'processQuestions'){
                $main_title = 'Test Results';
            }
            
            else if($this->uri->segment(2) == 'createaccount'){
                $main_title = 'Create Account';
            }
            
            else if($this->uri->segment(2) == 'index'){
                $main_title = 'Skill Assessment Test';
            }         
            else{
                $main_title = $this->uri->segment(2);
            }
            
            ?>
        <br />
        
        <?php echo "<h2 class='logo_font2'>".strtoupper($main_title)."</h2>"; ?>
    </div>
    
    
    <h1 class="logo_font">&nbsp;</h1>


    <div id="menu">
        <ul class="semiopaquemenu">
           
            <?php
                if($this->session->userdata('username')){
                ?>
            <li class= "<?php echo $main_title=='Dashboard'?"actived":"" ?>"><?php echo anchor("dashboard", "Dashboard" ) ?></li>
               <li class= "<?php echo $main_title=='employabilitree'?"actived":"" ?>"><?php echo anchor("home/employabilitree", "Employabilitree") ?></li>
               <li  class= "<?php echo $main_title=='assessment'?"actived":"" ?>" ><?php echo anchor("home/assessment", "Assessment" ) ?></li>
               <li class= "<?php echo $main_title=='ask'?"actived":"" ?>"><?php echo anchor("home/ask", "Ask") ?></li>
                <?php
                }
 else { ?>
      <li><?php echo anchor("dashboard", "Back to Login") ?></li>
     <?php
     }
            ?>
        </ul>
    </div>
    <div class="bottombar"></div>
</div>
<div class="clear"></div>
