<?php
 $assets= $this->config->item('assets');
$this->load->view("css/dashboard.php" );
// Assessment Graph data
$assessments = $this->reports->getAssessmentReports("assessment")->result_array();
$assessments_personal = $this->reports->personalAssData();
$assessments_population = $this->reports->populationAssData();
// Category Graph data
$field = "C.CATEGORY_NAME";
$categories = $this->reports->getCategoriesReports($field)->result_array();
$categories_personal = $this->reports->personalCatData();
$categories_population = $this->reports->populationCatData();
// Skills Graph Data
$skill_field = "S.skill_title";
$skills = $this->reports->getSkillsReports($skill_field)->result_array();
//var_dump($skills);die;
$skills_personal = $this->reports->personalSkillsData();
$skills_population = $this->reports->populationSkillsData();
?>

<script type="text/javascript" src="<?php echo $js; ?>/fs/fusioncharts.js" /></script>
<script type="text/javascript" src="<?php echo $js; ?>/fs/fusioncharts.charts.js" /></script>
<script type="text/javascript" src="<?php echo $js; ?>/fs/themes/fusioncharts.theme.ocean.js" /></script>
<script type="text/javascript" src="<?php echo $js; ?>/fs/themes/fusioncharts.theme.carbon.js" /></script>
<script type="text/javascript" src="<?php echo $js; ?>/fs/themes/fusioncharts.theme.fint.js" /></script>
<script type="text/javascript" src="<?php echo $js; ?>/fs/themes/fusioncharts.theme.zune.js" /></script>

<script type="text/javascript">
   
    FusionCharts.ready(function () {

var assChart = new FusionCharts({
        "type": "mscombidy2d",
        "renderAt": "assessment-graph",
        "width": "100%",
        "height": "400",
        "dataFormat": "json",
        "dataSource": 
    {
    "chart": {
        "caption": "Assessment Score",
        "xaxisname": "Assessments",
        "palette": "1",
        "animation": "1",
        "formatnumberscale": "0",
        "numbersuffix": "%",
        "showvalues": "0",
        "seriesnameintooltip": "0",
        "showborder": "0",
        "labelDisplay":"Rotate",
        "slantLabels":"1",
        "theme":"fint"
    },
    "categories": [
        {
            "category": <?php echo json_encode($assessments); ?>,
        }
    ],
    "dataset": [
        {
            "seriesname": "Own Score",
            "data": <?php echo json_encode($assessments_personal); ?>,
        },
        {
            "seriesname": "Population Average",
            "parentyaxis": "S",
            "renderas": "Line",
            "data":  <?php echo json_encode($assessments_population); ?>,
        }
    ]
}
}).render();
});
FusionCharts.ready(function () {
 new FusionCharts({
        "type": "mscombidy2d",
        "renderAt": "category-graph",
        "width": "100%",
        "height": "400",
        "dataFormat": "json",
        "dataSource": 
    {
    "chart": {
        "caption": "Categories Score",
        "xaxisname": "Categories",
        "palette": "1",
        "animation": "1",
        "formatnumberscale": "0",
        "numbersuffix": "%",
        "showvalues": "0",
        "seriesnameintooltip": "0",
        "showborder": "0",
        "labelDisplay":"Rotate",
        "slantLabels":"1",
        //"theme":"default"
    },
    "categories": [
        {
            "category": <?php echo json_encode($categories); ?>,
        }
    ],
    "dataset": [
        {
            "seriesname": "Own Category Score",
            "data": <?php echo json_encode($categories_personal); ?>,
        }
        ,
        {
            "seriesname": "Population Category Score",
            "parentyaxis": "S",
            "renderas": "Line",
            "data": <?php echo json_encode($categories_population); ?>,
        }
    ]
}
}).render();
});
FusionCharts.ready(function () {
new FusionCharts({
        "type": "mscombi2d",
        "renderAt": "skills-graph",
        "width": "100%",
        "height": "400",
        "dataFormat": "json",
        "dataSource": 
    {
    "chart": {
        "caption": "Skills Score",
        "xaxisname": "Skills",
        "palette": "1",
        "animation": "1",
        "formatnumberscale": "0",
        "numbersuffix": "%",
        "showvalues": "0",
        "seriesnameintooltip": "0",
        "showborder": "0",
        "theme":"zune",
        "labelDisplay":"Rotate",
        "slantLabels":"1",
    },
    "categories": [
        {
            "category": <?php echo json_encode($skills); ?>,
        }
    ],
    "dataset": [
        {
            "seriesname": "Own Skills Score",
            "color": "98B637",
            "data": <?php echo json_encode($skills_personal); ?>,
        },
        {
            "seriesname": "Population Skills Score",
            "parentyaxis": "S",
            "color": "f8bd19",
            "renderas": "Line",
            "data": <?php echo json_encode($skills_population); ?>,
        }
    ]
}
}).render();
});

</script>


<div class="row">
                <div class="col-md-3">
                    <div class="dashboard-stat" style="background: #7DA302;">
                            <div class="col-md-12">
                                <i  style="color: #fff !important; " class="fa fa-bar-chart"></i>
                                <div class="" style=" float: right; color: #fff; font-size: 16px !important; font-weight: bold;">
                                    Total Assessments <?php echo count($assessments)?>
                                </div>
                            </div>

                                <div style="margin-top: auto; text-align: right; font-size: 12px; color: #fff; border-bottom: 1px solid #F3F3F3;">
                                     View details
                                </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-stat" style="background: #E59729;">
                        <div class="col-md-12">
                                <i  style="color: #fff !important;" class=" fa fa-list-ol"></i>
                                <div class="" style=" float: right; color: #fff; font-size: 16px !important; font-weight: bold;">
                                   Total Categories  <?php echo count($categories)?>
                                </div>
                            </div>

                                <div style="margin-top: auto; text-align: right; font-size: 12px; color: #fff; border-bottom: 1px solid #F3F3F3;">
                                     View details
                                </div>
                    </div>
                </div>
            <div class="col-md-3">
            <div class="dashboard-stat" style="background: #04476C;">
                            <div class="col-md-12">
                                <i  style="color: #fff !important;" class=" fa fa-chain"></i>
                                <div class="" style=" float: right; color: #fff; font-size: 18px !important; font-weight: bold;">
                                    Total Skills <?php echo count($skills)?>
                                </div>
                            </div>

                                <div style="margin-top: auto; text-align: right; font-size: 12px; color: #fff; border-bottom: 1px solid #F3F3F3;">
                                     View details
                                </div>
                    </div>
            </div>
                <div class="col-md-3">
                    <div class="dashboard-stat" style="background: #438EB9;">
                            <div class="col-md-12">
                                <i  style="color: #fff !important;" class=" fa fa-area-chart"></i>
                                <div class="" style=" float: right; color: #fff; font-size: 18px !important; font-weight: bold;">
                                    Total Subskills  <?php echo count($subskill)?>
                                </div>
                            </div>

                                <div style="margin-top: auto; text-align: right; font-size: 12px; color: #fff; border-bottom: 1px solid #F3F3F3;">
                                     View details
                                </div>
                    </div>
                </div>
           </div>

            <div class="container-fluid" >
                <div class="col-md-4" id="assessment-graph" style="margin-top: 50px !important;"></div>    
                <div class="col-md-8" id="category-graph" style="margin-top: 50px !important;"></div>   
            </div>
            <div class="container-fluid" >
                <div class="col-md-" id="skills-graph" style="margin-top: 50px !important;"></div>    
                   
            </div>

  