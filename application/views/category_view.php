
<?php
$bg_image = $this->assessments->getCategoryBackground($category);
foreach ($bg_image as $bg):
    $background = $bg->BACKGROUND_IMAGES;
    $link = $bg->CATEGORY_NAME;
    $count = 0;
endforeach;
?>
<!--        <div style="width: 100%;margin-left: 50px; font-size: 11px; color: #2a8e20;">Home &nbsp;&raquo;&nbsp;<?php echo anchor('home/assessment', 'Assessment') ?>&nbsp;&raquo;&nbsp;<?php echo $link ?></div>-->
<div class="row">

    <div class="col-md-4"><image src="<?php echo $images . 'category_bg/' . $background; ?>"style=" magin-left:0px; width: 90%; height: 400px;"></div>

    <div class="col-md-8">
        <?php
        $rows = $this->assessments->getAllCategoryData($category);
        //var_dump($rows);
        foreach ($rows as $row) {
            ?>
                <div class="col-md-4">
            <?php
            
            echo '<fieldset><legend>' . ($count + 1) . '. ' . $row->skill_title . '</legend>';
            if ($this->assessments->checkSkills($row->id)) {
                $img = base64_encode($row->icon_path);
                $link = $this->assessments->skillHasSubs($row->id)? "assessment/subskills/$row->id/$img" : "questions/index/$row->id";
                //echo $this->assessments->checkSkills($row->id);
                echo anchor($link, "<img  src='" . $images . $row->icon_path . "' style='width: 110px; height: 120px;' />
                                                     
                        ", array("class" => ""));
                //$_SESSION["skill_image'] = "<img class='level_image' src='".$images.''.$row->icon_path."'/>";
            } else {
                echo "<img  src='" . $images . $row->icon_path . "'' class='blurr' style='width: 110px; height: 120px;' /> ";
            }
            ?>
            <div style="display: block;">
                <?php
                echo anchor("assessment/categ_audio/$row->id/skills/audio", "<img  src='" . $images . "bg/aud.png" . "'  width='30px' height='30px' hspace='5' title='Listen to Clip' aligh='left'/>
                            ", array("class" => "fancybox fancybox.ajax"));
                echo anchor("assessment/categ_video/" . base64_encode($row->id) . "/skills/video_path", "<img  src='" . $images . "bg/vid.png" . "'  width='30px' height='30px' hspace='5' title='Watch the Video' aligh='left'/>
                            ", array("class" => "fancybox fancybox.ajax"));

                if ($row->pdf <> "")
                    echo anchor($base . 'downloads/' . $row->pdf, "<img  src='" . $images . "bg/read.png" . "'  width='30px' height='30px' hspace='5' title='Download the pdf format' aligh='left'/>
                            ", array("target" => "_blank"));
                else
                    echo "<img  src='" . $images . "bg/read.png" . "'  width='30px' height='30px' hspace='5' title='Download the pdf format' aligh='left'/>
                            ";
                 ?>
            </div>
                    <?php
                echo '</fieldset>';
                // echo "</li>";
//             if(($count/4 == 1) OR ($count/4 == 2) OR ($count/4 == 3) OR ($count/4 == 4))
//                  echo '\n';
                $count++;
                ?>
            </div>
                <?php
            }
            ?>


        </div>
    </div>
</div>

