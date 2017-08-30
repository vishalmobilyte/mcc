<?php
$sd4 = 0;
$sd3 = 0;
$sd2 = 0;
$sd1 = 0;
 foreach ($sam_chilldren as $sam_dt){
              switch ($sam_dt['sam_result_id']) {
								case "4SD":
									 $sd4+= 1;
									break;
								case "3SD":
									 $sd3+= 1;
									break;
								case "2SD":
									 $sd2+= 1;
							     	break;
								case "1SD":
									 $sd1+= 1;
							     	break;
				}
						      
		 }
		 
$suw    = 0;
$muw    = 0;
$normal = 0;
foreach ($saw_chilldren as $saw_dt){
             switch ($saw_dt['saw_result_id']) {
                case "SUW":
                   $suw+= 1;
                  break;
                case "MUW":
                   $muw+= 1;
                  break;
                case "NORMAL":
                   $normal+= 1;
                    break;
                
        }
}
?>
<!-- END PAGE HEADER-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?= HTTP_ROOT.'users/dashboard'; ?>">Dashboard</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Children management</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="fa fa-child"></i>
                    <span class="caption-subject bold uppercase"> Children management</span>
                </div>
                <!-- <div class="list-inline mb-0 pull-right">
                    <a href="<?php echo HTTP_ROOT; ?>anganwadis/add-agw" class="nav-link ">
                        <button id="sample_editable_1_new" class="btn sbold green"> Add new
                            <i class="fa fa-plus"></i>
                        </button>
                    </a>
                </div> -->
            </div> 
            <div class="portlet-body">
                <div class="portlet light bordered">
                  
                   <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="commonDatatable">
                            <thead>
                                <tr>
                                    <th class="all">Sr. no</th>
                                     <th class="all">Name</th>
                                    <th class="all">Age(months)</th>
                                    <th class="all">Gender</th>
                                    <th class="all">Father Name</th>
                                    <th class="all">Worker Name</th>
                                    <th class="all">Anganwadi</th>
                                    <th class="all">SAM</th>
                                    <th class="all">SUW</th>
                                   
                                    <!-- <th class="min-tablet">Role</th> -->
                                    <?php if(($authUser['role'] == 1) || ($authUser['role'] == 2)){ ?>
                                    <?php } ?>
                                    <th class="none">Submitted</th>
                                    <th class="none">SAM/SUW Details</th>
                           
                                  
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $i=1;
                            foreach ($aw_data as $anganwadi): 
                               // print_r($anganwadi); die;
                                ?>
                            <tr>
                                <td class="text-center"><?= $this->Number->format($i) ?></td>
                                <td class="sorting_1 bold"><?= $anganwadi['name'] ?></td>
                                <td><?= $anganwadi['age'] ?></td>
                                <td><?= $anganwadi['gender'] ?></td>
                                <td><?= $anganwadi['father_name'] ?></td>
                                <td><?= $anganwadi['worker']['name'] ?></td>
                                <td><?= $anganwadi['worker']['anganwadi']['name'].'('.$anganwadi['worker']['anganwadi']['rbsk_team']['name'].')' ?></td>
                                <?php  
                                      $style_sam = ""; 
                                      switch (@$anganwadi['sam_child'][0]['sam_result_id']) 
                                      {
                                          case "1SD":
                                            $style_sam = "style='background-color: #008000 !important'";
                                            break;
                                          case "2SD":
                                            $style_sam = "style='background-color: #ffff00 !important'";
                                            break;
                                          case "3SD":
                                            $style_sam = "style='background-color: #DC143C !important'";
                                            break;
                                          case "4SD":
                                            $style_sam = "style='background-color: #FF0000 !important'";
                                          break;
                                      } 

                                      $style_saw = ""; 
                                      switch (@$anganwadi['saw_child'][0]['saw_result_id']) 
                                      {
                                          case "SUW":
                                            $style_saw = "style='background-color: #DC143C !important'";
                                            break;
                                          case "MUW":
                                             $style_saw = "style='background-color: #ffff00 !important'";
                                            break;
                                          case "NORMAL":
                                             $style_saw = "style='background-color: #008000 !important'";
                                              break;
                                      }
                                ?>
                                <td <?= $style_sam ?> ><?= @$anganwadi['sam_child'][0]['sam_result_id'] ?></td>
                                <td <?= $style_saw ?> ><?= @$anganwadi['saw_child'][0]['saw_result_id'] ?></td>
                               
                                
                                <!-- <td><?= @$roles[$anganwadi->role] ?></td> -->
                                <td><?= !empty($anganwadi->created_at) ? (date('M jS, Y', strtotime( $anganwadi->created_at ) )):"" ?></td>
                                 <td><?= $this->Html->link(__('SAM'), ['action' => 'listing-sam', base64_encode(convert_uuencode($anganwadi->id))],['title' => 'Edit', 'escape' => false, 'class'=> ''] ) ?>  &nbsp;| <?= $this->Html->link(__('SUW'), ['action' => 'listing-saw', base64_encode(convert_uuencode($anganwadi->id))],['title' => 'Edit', 'escape' => false, 'class'=> ''] ) ?> </td>
                               
                               
                            </tr>
                            <?php 
                            $i++;
                            endforeach; ?>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
<!-- END EXAMPLE TABLE PORTLET-->
  </div>
	<div class="col-md-6">
        
        <div class="portlet light bordered">
          <div class="portlet-title">
          <div class="caption font-green">
            <i class="fa fa-location-arrow font-green">
            </i>
            <span class="caption-subject bold uppercase">Malnutrition SAM Graph 
            </span>
          </div>
          <div class="tools"> 
          </div>
          </div>
          <div class="portlet-body">
         <div id="chartdiv" class="chartdiv"></div>
          </div>
          </div>
  </div>
  <div class="col-md-6">
        
        <div class="portlet light bordered">
          <div class="portlet-title">
          <div class="caption font-green">
            <i class="fa fa-location-arrow font-green">
            </i>
            <span class="caption-subject bold uppercase">Malnutrition SUW Graph 
            </span>
          </div>
          <div class="tools"> 
          </div>
          </div>
          <div class="portlet-body">
         <div id="chartdiv_malnutrition_saw" class="chartdiv"></div>
          </div>
          </div>
  </div>
</div>

<!-- Styles -->
<style>
#chartdiv , .chartdiv{
	width		: 100%;
	height		: 500px;
	font-size	: 11px;
}					
</style>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<!-- Chart code -->
<script>
var chart = AmCharts.makeChart( "chartdiv", {
  "type": "serial",
  "theme": "light",
  "dataProvider": [ {
    "SD": "-4SD",
    "childern": <?php echo $sd4 ?>,
	"color":"#FF0000"
  }, {
    "SD": "-3SD",
    "childern": <?php echo $sd3 ?>,
	  "color": "#FF0000",
  }, {
    "SD": "-2SD",
    "childern": <?php echo $sd2 ?>,
	"color":"#ffff00"
  }, {
    "SD": "-1SD",
    "childern": <?php echo $sd1 ?>,
	"color":"#008000"
  } ],
  "valueAxes": [ {
    "gridColor": "#FFFFFF",
    "gridAlpha": 0.2,
    "dashLength": 0,
	"title": "Number of Children"
  } ],
  "gridAboveGraphs": true,
  "startDuration": 1,
  "graphs": [ {
    "balloonText": "[[category]]: <b>[[value]]</b>",
    "fillAlphas": 0.8,
    "lineAlpha": 0.2,
    "type": "column",
	"colorField" : "color",
    "valueField": "childern"
  } ],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "SD",
  "categoryAxis": {
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 20,
	"title":"Standard Deviation"
  },
  "export": {
    "enabled": false
  }
} );

/*******************Chart for saw malnutrition****************************/

var chart = AmCharts.makeChart( "chartdiv_malnutrition_saw", {
  "type": "serial",
  "theme": "light",
  "dataProvider": [ {
    "SD": "SUW",
    "childern": <?php echo $suw ?>,
  "color":"#DC143C",
  }, {
    "SD": "MUW",
    "childern": <?php echo $muw ?>,
    "color":"#ffff00",
  }, {
    "SD": "NORMAL",
    "childern": <?php echo $normal ?>,
  "color":"#008000",
  }],
  "valueAxes": [ {
    "gridColor": "#FFFFFF",
    "gridAlpha": 0.2,
    "dashLength": 0,
  "title": "Number of Children"
  } ],
  "gridAboveGraphs": true,
  "startDuration": 1,
  "graphs": [ {
    "balloonText": "[[category]]: <b>[[value]]</b>",
    "fillAlphas": 0.8,
    "lineAlpha": 0.2,
    "type": "column",
  "colorField" : "color",
    "valueField": "childern"
  } ],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "SD",
  "categoryAxis": {
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 20,
  "title":"Standard Deviation"
  },
  "export": {
    "enabled": true
  }
} );
setTimeout(function(){
	$("#chartdiv a").remove();
 
}, 900);
</script>

<!-- HTML -->
