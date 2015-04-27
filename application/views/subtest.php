
<?php
echo anchor("assessment/loadcategory/" . $this->session->userdata('category_id'), "<img src=$images/back-button_green.png width='100px' height='50px' title='Back to Skill' >");
$rows = $this->question->getSubQuestions($id);
if ($rows) {
    ?>
    <div class="container-fluid">
        <div style="padding: 20px; background-color: #fff;" class="col-md-10">
            <center>
                <h3>Please Attempt Sub-Skill Evaluation Test</h3>
                <hr />
            </center>
        </div>
    </div>
    <?php
    $values = 'class = "carsForm"';
    echo form_open("questions/processQuestions/$id", $values);

    $qst_no = 0;

    $qns = count($rows);
    ?>
    
    <div class="row">
        <div class="col-md-7 col-xs-12 col-sm-7">Sub - Skill Question</div>
        <div class="col-md-1 col-xs-3 col-sm-1">Low</div>
        <div class="col-md-1 col-xs-3 col-sm-1">Medium</div>
        <div class="col-md-1 col-xs-3 col-sm-1">High</div>
        <div class="col-md-2 col-xs-3 col-sm-1">Very High</div>
    </div>
    <?php
    foreach ($rows as $row):
        ?>
    <div class="row">

            <div class="col-md-7 col-sm-12">
                <?php
                $qst_no = $qst_no + 1;
                echo $qst_no . '. ' . $row->QUESTION;
                $question_id = $row->QUESTION_ID;
                ?>
            </div>

            <div class="col-md-5">
                <font class='col-md-12'>
                <input type="range"  name='quest_<?= $row->QUESTION_ID ?>' min="1" max="10" step="1" value="3" >
                </font>
                <output></output>
            </div>
        </div>
        
        <?php
    endforeach;
    ?>
    
    <?php
    echo form_hidden('qns', $qns);
   ?>
<div class="modal-footer">
<div class="row">
    <div class="col-md-3 col-md-offset-8">
<?php
    echo form_submit(array("name" => "Submit", "class" => "btn btn-success"), "Submit test evalution");
?>
    </div>
    </div>
    </div>
<?php
    echo form_close();
} else
    Echo 'Sorry! Sub-Skill assessment Test is pending!';
?>


