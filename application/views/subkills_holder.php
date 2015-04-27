<?php $css_path = $this->config->item('base_url') . "/media/css"; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="HandheldFriendly" content="true">
        <title><?php echo $title; ?></title>
    </head>
    <link rel="stylesheet" href="<?php echo $assessment_css ?>" />

<!-- Add jQuery library -->
<script type="text/javascript" src="<?php echo $js; ?>/jquery-1.9.1.js" /></script>

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

<style>
    level_image{ width: 150px; height: 150px; }
    .blurr{
         filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale"); /* Firefox 10+, Firefox on Android */
filter: gray; /* IE6-9 */
-webkit-filter: grayscale(100%); /* Chrome 19+, Safari 6+, Safari 6+ iOS */

    }
</style>

<?php $this->load->view('fancybox_scripts'); ?>
<body>
    <div id="mainContainer">
      <?php $this->load->view('menu');
        $base = $this->config->item('images'); ?>
<div style="background: url(<?php echo "$images/1.png"; ?>) no-repeat center; width: 900px; height: 100%; margin:20px 0px 0px 150px; ">
<div style="width: 600px; margin: 0 auto; padding-top: 5px; font-size: 12px;">
<?php
$rows = $this->assessments->getSubSkillDetails($id);

foreach($rows as $row){
    echo "<center><h2>$row->subskill</h2>";
    echo "<img class='level_image' src='".$images.''.$row->image."' width='200px'  height='200px' />";
    echo "<div class='notes'><p align='justify'>$row->notes</p><div>";
    $link = $row->video; 
    
    ?>
    <br /><br />
    <?php
    echo anchor("questions/subskills/$id", "<center><font class='btn btn-success'>Take a test on this skill</font><center>"); 
 ?>
    <br /><br />
    <?php
    if(($link <> ""))
    {
    ?>
       
   <center>
   <?php echo $link ?>
         </center>
        <?php
         
    }           
      

}
?>
   
 <?php //echo anchor("questions/index/$skill_id", "<center><button class='btn btn-success'>Take a test on this skill</button><center>");   ?>     

</div>  </div>
<div style="clear: both"></div>
        <br />
        
        </div>
        <div style="clear: both"></div>
        <?php $this->load->view('footer'); ?>
    </div>
</body>
</html>