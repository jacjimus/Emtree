<div class="container">
    <div class="row">
        <div class="col-md-11 col-md-offset-1">   
                <h3>Post us a question</h3>
                <?php echo $this->session->flashdata('send_question'); ?>
        </div>
    </div>
    <div class="form-group">
                    <?php echo validation_errors(); ?>  
<?php echo form_open('home/sendquestion' ,array("id"=>"demo2")); ?>
<label for="access" class="col-md-4 control-label">First Name:</label>
<div class="col-md-8" style="margin-bottom:10px;">
<?php
echo form_input(array("name" => "firstname", "class" => "form-control", "placeholder" => "Name", "required" => true), ""); ?>
    </div>
    </div>
    <div class="form-group">
<label for="access" class="col-md-4 control-label">Last Name</label>
<div class="col-md-8" style="margin-bottom:10px;">
    <?php
                                echo form_input(
                                        array(
                                    "name" => "lastname",
                                    "class" => "form-control",
                                    "placeholder" => "Surname",
                                    "required" => true
                                        ), "");
                                ?>

</div>
</div>
    <div class="form-group">
<label for="access" class="col-md-4 control-label">Email Address:</label>
<div class="col-md-8" style="margin-bottom:10px;">
        <input type="email" name = "email" class = "form-control"  placeholder = "Email Address" required />
        </div>
        </div>
 
    <div class="form-group">
<label for="access" class="col-md-4 control-label">Institution:</label>
<div class="col-md-8" style="margin-bottom:10px;">
                                <?php
                                $rows = $this->dropdown->generateDropDown("institutions");
                                foreach ($rows as $row):
                                    $category_array[''] = 'Select';
                                    $category_array[$row['InstitutionID']] = $row['Institution'];
                                endforeach;

                                $data = $category_array;
                                echo form_dropdown('institution', $data, set_value('insitution') , "class='form-control'");
                                ?>   

</div>
</div>
    <div class="form-group">
      <label for="access" class="col-md-4 control-label">Query Category:</label>
    <div class="col-md-8" style="margin-bottom:10px;"> 
<?php
                                //Repeated ***
                                $query = $this->dropdown->generateDropDown("questionscategory");
                                foreach ($query as $que):
                                    $query_array[''] = 'Select';
                                    $query_array[$que['Query_category']] = $que['Query_category'];
                                endforeach;

                                $cates = $query_array;
                                echo form_dropdown('questionCategory', $cates, '' , "class='form-control'");
                                ?>   
      </div>
      </div>

    <div class="form-group">
 <label for="question" class="col-md-4 control-label">Query:</label>
<div class="col-md-8" style="margin-bottom:10px;">
     <?php
                                echo form_textarea(array("name" => "question", "class" => "form-control", "required" => true,
                                    'onKeyDown' => "limitText(this.form.question,this.form.countdown,250)",
                                    "onKeyUp" => "limitText(this.form.question,this.form.countdown,250);"), "");
                                ?>
 </div>
 </div>
 <div class="form-group">
 
 <div class="col-md-4 col-md-offset-6">   
 You have <input readonly type="text" name="countdown" id="countdown" size="3" value="250"> characters left.

 </div>
 </div>
 <br />
 <br />
 <br />
    <div class="form-group">
    <label for="hearaboutus" class="col-md-4 control-label">How did you hear about Emtree360?:</label>
    <div class="col-md-8" style="margin-bottom:10px;">
     <?php
                                $hears = $this->dropdown->generateDropDown("hearaboutus");
                                foreach ($hears as $hear) {
                                    $hear_array[''] = 'Select';
                                    $hear_array[$hear['HearID']] = $hear['Hear'];
                                }

                                $hearData = $hear_array;
                                echo form_dropdown('hearaboutus', $hearData, '' , "class='form-control'");
                                ?>   
    
    </div>
    </div>
    <div class="form-group">
        <div class="col-md-4 col-md-offset-6">
            
                                <?php echo form_submit(array("class" => "btn btn-success col-md-4"), "Send Question"); ?>
    
                        <?php form_close(); ?>
    </div>
    </div>
</div>
 
        <script language="javascript" type="text/javascript">
            
            function limitText(limitField, limitCount, limitNum) {
                if (limitField.value.length > limitNum) {
                    limitField.value = limitField.value.substring(0, limitNum);
                } else {
                    limitCount.value = limitNum - limitField.value.length;
                }
            }


            // unblock when ajax activity stops 
            $(document).ajaxStop($.unblockUI);

            function test() {
                $.ajax({url: '<?php echo $this->config->item('base_url') . "/home/sendquestion"; ?>', cache: false});
            }

            $(document).ready(function() {
                $('#pageDemo1').click(function() {
                    $.blockUI();
                    test();
                });
                $('#pageDemo2').click(function() {
                    $.blockUI({message: '<h1><img src="busy.gif" /> Just a moment...</h1>'});
                     
                    test();

                });
                
                $('#demo2').submit(function() { 
                    $.blockUI(
                       { css: { 
                        border: 'none', 
                        padding: '15px', 
                        backgroundColor: '#000', 
                        '-webkit-border-radius': '10px', 
                        '-moz-border-radius': '10px', 
                        opacity: .5, 
                        color: '#fff' 
                        } 
                }); 

                    setTimeout($.unblockUI, 10000); 
                });
                            $('#pageDemo3').click(function() {
                    $.blockUI({css: {backgroundColor: '#f00', color: '#fff'}});
                    test();
                });

                $('#pageDemo4').click(function() {
                    $.blockUI({message: $('#domMessage')});
                    test();
                });
            });

        </script> 
</body>
</html>