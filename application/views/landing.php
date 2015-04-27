
<div class="">
    <div class="row">
        <?php
        $count = 1;
        if (count($fetch) > 0) {
            echo " <h5>Please choose an assessment to attempt!</h5>";
            foreach ($fetch as $val):
                $activity = round($this->question->remaining($val->id), 0);
                $class = $activity == 100 ? "complete" : "showAssess";
                ?>
                <div class="col-md-4">
                    <?php
                    echo anchor("home/categories/$val->id", '<fieldset class="' . $class . '" ><legend>' . $count . '. ' . $val->assessment . '</legend>' .
                            "<div class='title'>" . $activity . "% Complete</div>"
                            . "<img class='assessment img-responsive' style='' src='$images/category_bg/$val->image_url' title='" . strtoupper($val->assessment) . "'  height='100' width='100'/>"
                            . "<p>" . $val->description . '</p>'
                            . ' </fieldset>');
                    ?>
                </div>
                <?php
                $count++;
            endforeach;
        }
        else {
            echo "<h5>Sorry! Your Institution is NOT entitled to any assessment!</h5>";
        }
        ?>
    </div>
</div>



