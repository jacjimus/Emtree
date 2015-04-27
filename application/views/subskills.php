<?php
$base = $this->config->item('images');
$background = base64_decode($background);
$categ = $this->assessments->getCategoryBackground($this->session->userdata('category_id'));
?>
<div class="row">
    <?php
    foreach ($categ as $cat):

        $link = $cat->CATEGORY_NAME;
        $id = $cat->CATEGORY_ID;
    endforeach;

    $skillname = $this->assessments->getSkillDetails($skill);
    foreach ($skillname as $skill)
        $skill = $skill->skill_title;
    ?>

<!--        <div style="width: 100%;margin-left: 50px; font-size: 11px; color: #2a8e20;">Home &nbsp;&raquo;&nbsp;<?php echo anchor('home/assessment', 'Assessment') ?>&nbsp;&raquo;&nbsp;<?php echo anchor("assessment/loadcategory/$id", $link) ?>&nbsp;&raquo;&nbsp;<?php echo $skill ?></div>-->

    <div class="col-md-4"><image src="<?php echo $images . $background; ?>"style=" magin-left:0px; width: 90%; height: 400px;"></div>


    <div class="col-md-8">
        <?php
        $rows = $this->assessments->getAllSubskillData($subskill);
        if ($rows) {
            $count = 1;
            foreach ($rows as $row) {
                ?>
                <div class="col-md-4">
                    <?php
                    echo '<fieldset><legend>' . ($count + 1) . '. ' . $row->subskill . '</legend>';
                    if ($this->assessments->checkSubSkills($row->subID)) {

                        echo anchor("questions/subskills/$row->subID", "<img  src='" . $images . $row->image . "'' />
                             ", array("class" => ""));
                    } else {
                        echo "<img  src='" . $images . $row->image . "'' class='blurr'/>
                            ";
                    }
                    ?>
                    <div style="display: block;">
                    <?php
                    echo anchor("assessment/categ_audio/$row->subID/subskills/audio", "<img  src='" . $images . "bg/aud.png" . "'  width='30px' height='30px' hspace='5' title='Listen to Clip' aligh='left'/>
                            ", array("class" => "fancybox fancybox.ajax"));
                    echo anchor("assessment/categ_video/" . base64_encode($row->subID) . "/subskills/video", "<img  src='" . $images . "bg/vid.png" . "'  width='30px' height='30px' hspace='5' title='Watch the Video' aligh='left'/>
                            ", array("class" => "fancybox fancybox.ajax"));

                    if ($row->pdf <> "")
                        echo anchor($base . 'downloads/' . $row->pdf, "<img  src='" . $images . "bg/read.png" . "'  width='30px' height='30px' hspace='5' title='Download the pdf format' aligh='left'/>
                            ", array("target" => "_blank"));
                    else
                        echo "<img src='" . $images . "bg/read.png" . "'  width='30px' height='30px' hspace='5' title='Download the pdf format' aligh='left'/>
                            ";
                    ?>
                    </div>
                        <?php
                    echo '</fieldset>';

                    $count++;
                    ?>
                </div>
                <?php
            }
        }
        else {
            echo "<i>There are no Sub Skills for this Skill.</i>";
        }
        ?>


    </div>
</div>

