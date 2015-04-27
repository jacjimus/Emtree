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

<div style="width: 250px; margin: 0 auto; padding-top: 5px; font-size: 12px;">
   
<?php
$audio = $this->assessments->getMedia($id, $type, $path);


foreach($audio as $a)
{
  if($a->$path <> "")
    {  
     
    ?>
       
   <center>
<!--   <embed src="<?php echo $this->config->item('base_url') ."/media/audio/".$a->$path?>" align="baseline" border="0" width="200" height="60" autostart="true" loop="true">
  -->
  <audio controls>
 <source src="<?php echo $this->config->item('base_url') ."/media/audio/".$a->$path?>"
         type='audio/mp3'>
 <!-- The next two lines are only executed if the browser doesn't support MP4 files -->
 <source src="http://media.w3.org/2010/07/bunny/04-Death_Becomes_Fur.oga"
         type='audio/ogg; codecs=vorbis'>
 <!-- The next line will only be executed if the browser doesn't support the <audio> tag-->
 <p>Your user agent does not support the HTML5 Audio element.</p>
</audio>  
   </center>
        <?php
}
else
 
    {
    ?>
       
   <center>
   <strong><i>No attached Audio clip to Play</i></strong>
         </center>
        <?php
         
    }	
         
    } 

 
?>
   </div>
