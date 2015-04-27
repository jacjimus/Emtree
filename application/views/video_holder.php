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

<div style="width: auto; margin: 0 auto; padding-top: 5px; font-size: 12px;">
<?php
$rows = $this->assessments->getMedia($id, $type , $path);

foreach($rows as $row){
   
   $link = $row->$path; 
    
    if($link <> "")
    {
    ?>
       
   <center>
   <?php echo $link ?>
         </center>
        <?php
         
    } 
	else
	{
	?>
<center>
   <?php echo "<i><strong>No linked Video to watch!</i></strong>" ?>
         </center>
        <?php	
      }

}
?>
  </div>
