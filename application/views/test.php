<?php
echo anchor("assessment/loadcategory/" . $this->session->userdata('category_id'), "<img src=$images/back-button_green.png width='100px' height='50px' title='Back to Skill' >");
$rows = $this->question->getQuestions($skill_id);
if ($rows) {
    ?>
    <div style="padding: 20px; background-color: #fff;">
        <center>
            <h3>Please Attempt Skill Evaluation Test</h3>
            <hr />
        </center>
        <?php
        $values = 'class = "carsForm"';
        echo form_open("questions/processQuestions/$skill_id", $values);

        $qst_no = 0;

        $qns = count($rows);
        ?>
        <table style="padding: 6px;">
            <thead>

            <th colspan="2">Skill Question</th>
            <th style="font-size: small;text-align: left">Extremely Low&nbsp;&nbsp;   Average&nbsp;&nbsp;&nbsp;Extremely High</th>
            </thead>
    <?php
    foreach ($rows as $row):
        echo "<tr></td><td width='60%'>";
        $qst_no = $qst_no + 1;
        echo $qst_no . '. ' . $row->QUESTION;
        $question_id = $row->QUESTION_ID;
        echo "</td><td width='5%'></td><td>";
        ?>


                <font class='cal-md-12'>
                <input type="range"  name='quest_<?= $row->QUESTION_ID ?>' min="1" max="10" step="1" value="3" >
                </font>
                <output></output>


                </td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td></td></tr>

        <?php
    endforeach;
    echo '</table>';
    echo form_hidden('qns', $qns);
    echo "<center>";
    echo form_submit(array("name" => "Submit", "class" => "btn btn-success"), "Submit test evalution");
    echo "</center>";

    echo form_close();
} else
    Echo 'Sorry! Skill assessment Test is pending!';
?>

</div>

<div id="footer" style="border-top: 1px #cccccc dashed; margin-top: 30px; padding: 20px;">
    <center>
        <a href="#">All rights reserved &copy <?php echo date('Y'); ?> Emtree360</a>
    </center>
</div>


</div>
