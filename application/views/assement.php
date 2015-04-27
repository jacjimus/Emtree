
<?php
$base = $this->config->item('images');
?>

<h5>List of Skill Assessment Categories</h5>
<div class="">
    <div class="row">
        <?php
        $count = 1;
        foreach ($fetch as $val):
            ?>
            <div class="col-md-3">
                <?php
                echo '<fieldset><legend>' . $count . '. ' . $val->CATEGORY_NAME . '</legend>';
                if (!$this->assessments->checkRoot($val->CATEGORY_ID)) {
                    echo anchor("assessment/loadcategory/$val->CATEGORY_ID", "<img class='assement img-responsive' style='text-align: center;' src='$images/category_bg/$val->BACKGROUND_IMAGES' title='" . strtoupper($val->CATEGORY_NAME) . "' />");
                } else {
                    echo "<img class='blurr_assessment img-responsive' src=' $images/category_bg/$val->BACKGROUND_IMAGES' style='text-align: center;' />";
                }
                echo '<br /><br /> ';
                ?>
                <div style="display: inline;">
                    <?php
                    echo anchor("assessment/categ_audio/$val->CATEGORY_ID/category/AUDIO", "<img  src='" . $images . "bg/aud.png" . "'  width='30px' height='30px' hspace='5' title='Listen to Clip' aligh='left'/>
                            ", array("class" => "fancybox fancybox.ajax"));
                    echo anchor("assessment/categ_video/" . base64_encode($val->CATEGORY_ID) . "/category/VIDEO_URL", "<img  src='" . $images . "bg/vid.png" . "'  width='30px' height='30px' hspace='5' title='Watch the Video' aligh='left'/>
                            ", array("class" => "fancybox fancybox.ajax"));

                    if ($val->PDF_URL <> "")
                        echo anchor($base . 'downloads/' . $val->PDF_URL, "<img  src='" . $images . "bg/read.png" . "'  width='30px' height='30px' hspace='5' title='Download the pdf format' aligh='left'/>
                            ", array("target" => "_blank"));
                    else
                        echo "<img  src='" . $images . "bg/read.png" . "'  width='30px' height='30px' hspace='5' title='Download the pdf format' aligh='left'/>
                            ";
                    echo '</div>';
                    echo '</fieldset>';
                    // echo "</li>";
//             if(($count/4 == 1) OR ($count/4 == 2) OR ($count/4 == 3) OR ($count/4 == 4))
//                  echo '\n';
                    $count++;
                    ?>
                </div>
                <?php
            endforeach;
            ?>
        </div>
    </div>
</div>


