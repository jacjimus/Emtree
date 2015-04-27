<?php $css_path = $this->config->item('base_url') . "/media/css"; ?>
<style type="text/css">
    @font-face {
        font-family: 'scribbleregular';
        src: url('<?php echo $css_path; ?>/fonts/scribbleregular.eot');
        src: url('<?php echo $css_path; ?>/fonts/scribbleregular.eot?#iefix') format('embedded-opentype'),
            url('<?php echo $css_path; ?>/fonts/scribbleregular.woff') format('woff'),
            url('<?php echo $css_path; ?>/fonts/scribbleregular.ttf') format('truetype'),
            url('<?php echo $css_path; ?>/fonts/scribbleregular.svg#scribbleregular') format('svg');
        font-weight: normal;
        font-style: normal;
    }
 
    @font-face {
    font-family: 'noteworthyregular';
    src: url('<?php echo $css_path; ?>/fonts/noteworthy-webfont.eot');
    src: url('<?php echo $css_path; ?>/fonts/noteworthy-webfont.eot?#iefix') format('embedded-opentype'),
         url('<?php echo $css_path; ?>/fonts/noteworthy-webfont.woff') format('woff'),
         url('<?php echo $css_path; ?>/fonts/noteworthy-webfont.ttf') format('truetype'),
         url('<?php echo $css_path; ?>/fonts/noteworthy-webfont.svg#noteworthyregular') format('svg');
    font-weight: normal;
    font-style: normal;

}
@font-face {
    font-family: 'QikkiRegRegular';
    src: url('<?php echo $css_path; ?>fonts/Qarmic_sans_Abridged-webfont.eot');
    src: url('<?php echo $css_path; ?>fonts/Qarmic_sans_Abridged-webfont.eot?#iefix') format('embedded-opentype'),
         url('<?php echo $css_path; ?>fonts/Qarmic_sans_Abridged-webfont.woff') format('woff'),
         url('<?php echo $css_path; ?>fonts/Qarmic_sans_Abridged-webfont.ttf') format('truetype'),
         url('<?php echo $css_path; ?>fonts/Qarmic_sans_Abridged-webfont.svg#QikkiRegRegular') format('svg');
    font-weight: normal;
    font-style: normal;
}
    .logo_font
    {
        font-size: 36px; font-family: 'scribbleregular' !important; padding: 40px; margin-left: 50px;
    }
    h2
    {
        font-size: 32px; font-family: 'scribbleregular' !important; 
    }

    body{ margin: 0px; }
    
    .notes {
        max-height:autopx; overflow:auto; 
        font-family: 'QikkiRegRegular' !important;
    }
</style>
<div style="background: url(<?php echo "$images/1.png"; ?>) no-repeat center; width: 800px; height: 100%;">
<div style="width: 500px; margin: 0 auto; padding-top: 5px; font-size: 12px;">
<?php
$rows = $this->assessments->getSkillDetails($skill_id);

foreach($rows as $row){
    echo "<center><h2>$row->skill_title</h2>";
    echo "<img class='level_image' src='".$images.''.$row->icon_path."' width='200px'  height='200px' />";
    echo "<div class='notes'><p align='justify'>$row->notes</p><div>";
    $link = $row->video_path; 
    
    ?>
    <br /><br />
    <?php
    echo anchor("questions/index/$skill_id", "<center><font class='btn btn-success'>Take a test on this skill</font><center>"); 
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
