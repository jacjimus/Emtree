
<?php
    $css_path = $this->config->item('base_url') . "/media/css";
    $js_path = $this->config->item('base_url') . "/media/js";
?>
<script type="text/javascript" src="<?php echo $js_path ?>/jquery.js"></script>
<script type="text/javascript" src="<?php echo $js_path ?>/diQuery-collapsiblePanel.js"></script>
<style type="text/css">
   
    .namespace
    {
        width: 80%;
        margin-right: 100px; 
        border-spacing: 10px;
        border-collapse: separate; 
        font-size: 12px !important; 
        border: 1px solid #434534;
    }
    .trclass
    {
        padding:5px; 
    }
    .dataclass
    {
        width: 400px; 
        padding: 3px 0 3px 5px !important;
        background: #ccff84; 
        font-family: monospace; 
        font-weight: bold;
        color: #00cca5;
    }        
    .tdclass
    {
        width: 150px; 
        padding: 3px 0 3px 5px !important;
        background: #ccff84; 
        font-family: monospace; 
        font-weight: 700;
   }
   .tdL{
    border-top: 1px solid #ddd;   
    border-left: 1px solid #ddd;   
   }
   .tdR{
   border-right: 1px solid #ddd;   
   }
   
   .collapsibleContainer
{
    border: solid 1px #9BB5C1;
 
    margin: 40px;

}

.collapsibleContainerTitle
{
    cursor:pointer;
   
}

.collapsibleContainerTitle div
{
    text-align: left;
    padding-top:5px;
    padding-left:20px;
    background-color: #aeeeea !important;
    color: #0d0d0e;
    font-size: 12px;
    font-family: inherit;
    
}

.collapsibleContainerContent
{
    padding: 10px;
}
</style>

<html>
    <head>
        <title>EMPLOYABILITREE SCORE</title>
        <link rel="stylesheet" href="<?php echo $css_path; ?>/bootstrap.css" />
        <link rel="stylesheet" href="<?php echo $css_path; ?>/diQuery-collapsiblePanel.css" />
    </head>
    <body style="background-color: silver; margin-top: 1%; font-family: QikkiRegRegular;">
        <script>
if (!document.layers)
document.write('<div id="divStayTopLeft" style="position:absolute">')
</script>

<layer id="divStayTopLeft">

<!--EDIT BELOW CODE TO YOUR OWN MENU-->
<table border="1" width="150" cellspacing="0" cellpadding="0">
 
  <tr>
    <td width="100%" bgcolor="#FFFFFF">

<a href="" onclick="printDiv('printableArea')"> Print Report</a><br>
      
      </td>
  </tr>
</table>
<!--END OF EDIT-->

</layer>


<script type="text/javascript">

/*
Floating Menu script-  Roy Whittle (http://www.javascript-fx.com/)
Script featured on/available at http://www.dynamicdrive.com/
This notice must stay intact for use
*/

//Enter "frombottom" or "fromtop"
var verticalpos="frombottom"

if (!document.layers)
document.write('</div>')

function JSFX_FloatTopDiv()
{
	var startX = 3,
	startY = 150;
	var ns = (navigator.appName.indexOf("Netscape") != -1);
	var d = document;
	function ml(id)
	{
		var el=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
		if(d.layers)el.style=el;
		el.sP=function(x,y){this.style.left=x;this.style.top=y;};
		el.x = startX;
		if (verticalpos=="fromtop")
		el.y = startY;
		else{
		el.y = ns ? pageYOffset + innerHeight : document.body.scrollTop + document.body.clientHeight;
		el.y -= startY;
		}
		return el;
	}
	window.stayTopLeft=function()
	{
		if (verticalpos=="fromtop"){
		var pY = ns ? pageYOffset : document.body.scrollTop;
		ftlObj.y += (pY + startY - ftlObj.y)/8;
		}
		else{
		var pY = ns ? pageYOffset + innerHeight : document.body.scrollTop + document.body.clientHeight;
		ftlObj.y += (pY - startY - ftlObj.y)/8;
		}
		ftlObj.sP(ftlObj.x, ftlObj.y);
		setTimeout("stayTopLeft()", 10);
	}
	ftlObj = ml("divStayTopLeft");
	stayTopLeft();
}
JSFX_FloatTopDiv();
</script>
        <script type="text/javascript">
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}


</script>
        <div style="background-color: #fff; padding: 10px; margin: 0 auto auto 200px; width: 75%;  font-size: 9px !important;">
            <div  id="printableArea">
                <center>
                    <?php echo anchor("dashboard", "<img src='$images/logo_inner.png' style='float: left;' width='90px' height = '111px' style='margin-bottom : 10px'/>"); 
 
                    foreach ( $user As $u )
 
                    ?>
                    <table style="width: 80%;
        margin: 20px auto; 
        border-spacing: 10px;
        border-collapse: separate; 
        font-size: 13px !important; 
        border: 1px solid #434534; ">
      
                        <tr class="trclass"><td class="tdclass">First Name:</td><td class="dataclass"> <?php echo ucfirst($u->FIRST_NAME)?></td> <td class="tdclass">Last Name:</td><td class="dataclass"><?php echo ucfirst($u->SURNAME) ?></td></tr>
                        <tr class="trclass"><td class="tdclass">Sex:</td><td class="dataclass"> <?php echo ucfirst($u->SEX)?></td>  <td class="tdclass">Institution:</td><td class="dataclass"><?php echo ucfirst($u->Institution)?></td></tr>
                       
                        <tr class="trclass"><td class="tdclass">Subject:</td><td class="dataclass">Employabilitree Skills Assessment</td><td class="tdclass">Date:</td><td class="dataclass"><?php echo date("D d, M  Y")?></td></tr>
                        
                    </table>
 <?php ?>
                    <hr />
                
                <?php   $scoreTotal = 0;
                        $cat = 0;
                        $sum = 0;
                        $count = 0;
                        $categories = $this->assessments->loadCategories(1)->result();
                        
                        foreach($categories as $category){
                           
                            echo "<div  class='collapsibleContainer'  title='".strtoupper($category->CATEGORY_NAME);
                            echo nbs(5);
                            echo ' :: POPULATION AVERAGE SCORE: ';
                            echo $this->question->getaverage($category->CATEGORY_ID);
                            echo nbs(5);
                            echo 'YOUR AVERAGE SCORE: ';
                            echo $this->question->getPeraverage($category->CATEGORY_ID);
                            echo " %' >";
                           
                        //$levels = $this->question->getUserMatrix();
                        $levels = $this->assessments->getAllCategoryData($category->CATEGORY_ID);
                       foreach ($levels as $level){
                        ?>
						
                        <table class="table table-striped table-bordered"  style="width: 98%; font-size: 12px !important; border:1px solid #ddd; margin: 10px 0px 10px 0px;">
                            <tr style="border-top: 1px solid #ddd;border-left: 1px solid #ddd;">
                                <th style="width: 25%; border: 1px solid #ddd;">Skill</th>
                                <th style="width: 25%; border: 1px solid #ddd;">Sub-Skills</th>
                                <th style="width: 25%; border: 1px solid #ddd;">Population Average Score</th>
                                <th style="width: 25%; border: 1px solid #ddd;">Your Average  Score</th>
                            </tr>
                        <?php
                        
                        
                            $subskills = $this->question->getSubSkills($level->id);
                            $span = 1;
                            foreach($subskills as $subskill)
                            {
                            
                            ?>
                                
                                    <tr>
                                        <td <?php echo $span==1?'style="border: 1px solid #ddd;"':'' ?> ><?php echo $span==1 ? $level->skill_title : ""?></td>
                                        <td style="border: 1px solid #ddd;">
                                            <?php echo $subskill['subskill'] ?>
                                        </td>
                                        <td style="border: 1px solid #ddd;">
                                            <?php echo $this->question->getSubskillAverage($subskill['subID']) ?>
                                        </td>
                                        <td style="border: 1px solid #ddd;">
                                            <?php echo $this->question->getScore($subskill['subID']) ?>%
                                        
                                        </td>
                                    </tr>
                                
                            <?php
                             $span++; 
                            }
                           
                        };
                        ?>
                       </table>
                        </div>
            <?php
                    };
?>                   
 <div style="width: 100%">
                                        Results Summary:
 </div>

                                    <table style="width: 80%; font-size: 10px">
                                        <tr>
                                            <td width="40%">Your Average % Score:</td>
                                            <td><?php echo $this->question->getAverageScore() ?></td>
                                        </tr>
                                        <tr>
                                            <td width="40%">Population Average % Score:</td>
                                            <td><?php echo $this->question->getPopulationAverageScore() ?></td>
                                        </tr>
                                     
                                     
                                     </table>
</div>
             
            </center>
        </div>
 <script language="javascript" type="text/javascript">

    $(document).ready(function() {
        $(".collapsibleContainer").collapsiblePanel();

    });
</script> 
    </body>
</html>
