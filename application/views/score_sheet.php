
<?php

function generateBarGraph($percentage_score) {
    $color = '';

    $x = ($percentage_score / 100.0) * 600;


    if ($percentage_score < 40) {
        $color = 'red';
    }
    if ($percentage_score >= 40 && $percentage_score < 50) {
        $color = '#c6d58a';
    }
    if ($percentage_score >= 50 && $percentage_score < 70) {
        $color = '#bced52';
    }
    if ($percentage_score >= 70) {
        $color = '#2bee2f';
    }
    ?>
    <div class="col-md-10 col-md-offset-1">
        <div style='border: 2px solid #333; margin: 0px auto 0px auto !important;'>
            <div style='width: <?php echo $percentage_score; ?>%; height: 20px; background-color: <?php echo $color; ?>'></div>
        </div>
    </div>

    <?php
}
?>
<div class="row">
    <div class="col-md-11 col-md-offset-1">
        <center>
            <h6><?php echo ucfirst($this->assessments->getCategoryName($this->session->userdata('category_id'))); ?> &nbsp;&raquo;&nbsp;<?php echo ucfirst($this->assessments->getDetails($this->session->userdata('skill'))) ?> &nbsp&raquo; &nbsp;
                <?php
                $query = $this->assessments->getSkillDetails($subid);
                foreach ($query as $row)
                    echo ucfirst($title = $row->subskill)
                    ?></h6>
        </center>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            No of Questions : <font class="number"> <?php echo $total_questions_asked; ?></font>
        </div>
    </div>

    <?php generateBarGraph($percentage_score); ?>

    <div class="row">
        <div class="col-md-10 col-md-offset-1"> 
<!--                Total score: <font class="number"> <?php //echo round($total_score);    ?> / <?php //echo $total_questions_asked * 10;    ?><br /></font>-->
            Your Score : <font class="number"><?php echo round($percentage_score, 1); ?>%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>Population average Score:  <?php echo $this->assessments->percentageScore($subid) ?>%<font class="number"></font><br /><br />
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2 ">
            <p style="margin: 50px;"><?php echo anchor("assessment/loadcategory/" . $this->session->userdata('category_id'), "Continue with skills assessment" , array("class" => "btn-success btn-lg")) ?></p>
        </div>
    </div>




</div>

