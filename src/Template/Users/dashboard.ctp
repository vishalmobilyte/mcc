<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<span>Dashboard</span>
		</li>
	</ul>
</div> 

<h3 class="page-title"></h3>
	<!-- end admin details -->
	<!-- END PAGE TITLE-->
	<!-- END PAGE HEADER-->
	<!-- BEGIN DASHBOARD STATS 1-->
		<div class="row">
		
		<?php
$sd4 = 0;
$sd3 = 0;
$sd2 = 0;
$sd1 = 0;
 foreach ($sam_chilldren as $sam_dt){

   // print_r($sam_dt); die;
 
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
		 
?>
	<?php
$suw    = 0;
$muw    = 0;
$normal = 0;

 foreach ($saw_chilldren as $saw_dt){

   // print_r($saw_dt); die;
 
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
			
			<?php if (isset($authUser['role']) && in_array( $authUser['role'], ['1','2','3','4']) ) { ?>
										
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<a class="dashboard-stat dashboard-stat-v2 blue" href="<?php echo HTTP_ROOT.'users/workers-listing'; ?>">
						<div class="visual">
							<i class="fa fa-users"></i>  
						</div>
						<div class="details">
							<div class="number">
								<span data-counter="counterup" data-value="<?= $usersInfo['workersCount'] ?>">0</span>
							</div>
							<div class="desc"> Workers </div>
						</div>
					</a>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<a class="dashboard-stat dashboard-stat-v2 red" href="<?php echo HTTP_ROOT.'users/staff-listing'; ?>">
						<div class="visual">
							<i class="fa fa-users"></i>
						</div>
						<div class="details">
							<div class="number">
								<span data-counter="counterup" data-value="<?= $usersInfo['allUsersCount'] ?>">0</span> </div>
							<div class="desc"> Staff Members </div>
						</div>
					</a>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<a class="dashboard-stat dashboard-stat-v2 green" href="<?php echo HTTP_ROOT.'children/listing'; ?>">
						<div class="visual">
						   <i class="fa fa-users"></i>
						</div>
						<div class="details">
							<div class="number">
								<span data-counter="counterup" data-value="<?= $usersInfo['DataChildren'] ?>"></span>
							</div>
							<div class="desc"> Total Children </div>
						</div>
					</a>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<a class="dashboard-stat dashboard-stat-v2 purple" href="<?php echo HTTP_ROOT.'anganwadis/listing'; ?>">
						<div class="visual">
						   <i class="fa fa-users"></i>
						</div>
						<div class="details">
							<div class="number"> 
								<span data-counter="counterup" data-value="<?= $usersInfo['AnganwadisCount'] ?>"></span> </div>
							<div class="desc"> Total Anganwadis </div>
						</div>
					</a>
				</div>
			
			<?php } ?>
			
		</div>
                    
		<div class="clearfix"></div>
		 
		 <?php if (isset($authUser['role']) && in_array( $authUser['role'], ['1','2','3','4']) ) { ?>
			<div class="row">
								
			  <div class="col-md-6">
				
				<div class="portlet light bordered">
				  <div class="portlet-title">
					<div class="caption font-green">
					  <i class="fa fa-location-arrow font-green">
					  </i>
					  <span class="caption-subject bold uppercase">Children Data Till Today
					  </span>
					</div>
					<div class="tools"> 
					</div>
				  </div>
				  <div class="portlet-body">
					<div class="dataTables_wrapper no-footer" id="sample_2_wrapper">
					  
					  <div class="">
						<table width="100%" style="width: 100%;" aria-describedby="sample_2_info" role="grid" id="db_comming_users_listing" class="table table-striped table-bordered table-hover dt-responsive dataTable no-footer dtr-column collapsed">
						  <thead>
							<tr role="row">
							  <th aria-label="" style="width: 0px;" colspan="1" rowspan="1" class="control sorting_disabled text-center">Sr. no.
							  </th>
							  <th aria-label="" style="width: 0px;" colspan="1" rowspan="1" class="control sorting_disabled text-center">Name
							  </th>
							  <th aria-label="First name: activate to sort column descending" aria-sort="ascending" style="width: 114px;" colspan="1" rowspan="1" aria-controls="sample_2" tabindex="0" class="all sorting_disabled">Age
							  </th>
							  <th aria-label="Last name: activate to sort column ascending" style="width: 112px;" colspan="1" rowspan="1" aria-controls="sample_2" tabindex="0" class="min-phone-l sorting_disabled">Father Name
							  </th>
							  <th aria-label="Position: activate to sort column ascending" style="width: 223px;" colspan="1" rowspan="1" aria-controls="sample_2" tabindex="0" class="min-tablet sorting_disabled">Created Date 
							  </th>
							
							</tr>
						  </thead>
						  <tbody>
							  <?php 
							  $j=1;
							  foreach ($allChildren as $child_data): ?>
								<tr role="row" class="<?php if($j%2==0)echo 'even'; else echo 'odd'; ?>">
									<td class="text-center"><?php echo trim($this->Number->format($j)); ?></td>
									
									<td>
										<?php echo $child_data->name; ?>
									</td>
									
									<td>
										<?php echo $child_data->age; ?>
									</td>

									
									<td><?php echo $child_data->father_name; ?></td>

									<td><?= date('M jS, Y',strtotime($child_data->created_at)); ?></td>
									
								</tr>
							<?php 
								$j++;
								endforeach; 
							?>	
							
							
						  </tbody>
						</table>
					  </div>
					 </div>
				  </div>
				</div>
				
			  </div>
		
			  <div class="col-md-6">
				
				<div class="portlet light bordered">
				  <div class="portlet-title">
					<div class="caption font-green">
					  <i class="fa fa-fighter-jet font-green">
					  </i>
					  <span class="caption-subject bold uppercase">Children Data Collected today
					  </span>
					</div>
					<div class="tools"> 
					</div>
				  </div>
				  <div class="portlet-body">
					<div class="dataTables_wrapper no-footer" id="sample_2_wrapper">
					  
					  <div class="">
						<table width="100%" style="width: 100%;" aria-describedby="sample_2_info" role="grid" id="db_comming_users_listing1" class="table table-striped table-bordered table-hover dt-responsive dataTable no-footer dtr-column collapsed">
						  <thead>
							<tr role="row">
							  <th aria-label="" style="width: 0px;" colspan="1" rowspan="1" class="control sorting_disabled text-center">Sr. no.
							  </th>
							  <th aria-label="" style="width: 0px;" colspan="1" rowspan="1" class="control sorting_disabled text-center">Name
							  </th>
							  <th aria-label="First name: activate to sort column descending" aria-sort="ascending" style="width: 114px;" colspan="1" rowspan="1" aria-controls="sample_2" tabindex="0" class="all sorting_disabled">Age
							  </th>
							  <th aria-label="Last name: activate to sort column ascending" style="width: 112px;" colspan="1" rowspan="1" aria-controls="sample_2" tabindex="0" class="min-phone-l sorting_disabled">Father Name
							  </th>
							  <th aria-label="Position: activate to sort column ascending" style="width: 223px;" colspan="1" rowspan="1" aria-controls="sample_2" tabindex="0" class="min-tablet sorting_disabled">Created Date 
							  </th>
							
							</tr>
						  </thead>
						  <tbody>
							  <?php 
							  $i=1;
							  foreach ($todayChildren as $today_child): ?>
								<tr role="row" class="<?php if($i%2==0)echo 'even'; else echo 'odd'; ?>">
									<td class="text-center"><?php echo $this->Number->format($i); ?></td>
									<td><?= $today_child->name; ?></td>
									<td>
										<?= $today_child->age; ?>
									</td>
									<td>
										<?= $today_child->father_name; ?>
									</td>
									
									<td><?= date('M jS, Y',strtotime($today_child->created_at)); ?></td>
									
								</tr>
								
								
								
								
								<?php 
									$i++;
									endforeach;
								?>	
							</tbody>
						</table>
					  </div>
					 </div>
				  </div>
				</div>
				
			  </div>
		
			</div>

		 <?php } ?>
	  <div class="row">		
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
				<!-- <div class="col-md-6">
				<div class="portlet light bordered">
				  <div class="portlet-title">
					<div class="caption font-green">
					  <i class="fa fa-location-arrow font-green">
					  </i>
					  <span class="caption-subject bold uppercase">RBSK Team Graph
					  </span>
					</div>
					<div class="tools"> 
					</div>
				  </div>
				  <div class="portlet-body">
				 <div id="chartdiv2" class="chartdiv"></div>
				  </div>
				  </div>
				  </div> -->
				  </div>

				  <div class="row">	
				    <div class="col-md-6">
				    <div class="portlet light bordered">
				  <div class="portlet-title">
					<div class="caption font-green">
					  <i class="fa fa-location-arrow font-green">
					  </i>
					  <span class="caption-subject bold uppercase">RBSK Team SAM Graph
					  </span>
					</div>
					<div class="tools"> 
					</div>
				  </div>
				  <div class="portlet-body">
				 <div id="chartdiv3" class="chartdiv"></div>
				  </div>
				  </div>

				    </div>	

				     <div class="col-md-6">
				    <div class="portlet light bordered">
				  <div class="portlet-title">
					<div class="caption font-green">
					  <i class="fa fa-location-arrow font-green">
					  </i>
					  <span class="caption-subject bold uppercase">Blockwise SAM Graph
					  </span>
					</div>
					<div class="tools"> 
					</div>
				  </div>
				  <div class="portlet-body">
				 <div id="chartdiv4" class="chartdiv"></div>
				  </div>
				  </div>

				    </div>	

				  </div>
				  <div class="row">	
				    <div class="col-md-6">
				    <div class="portlet light bordered">
				  <div class="portlet-title">
					<div class="caption font-green">
					  <i class="fa fa-location-arrow font-green">
					  </i>
					  <span class="caption-subject bold uppercase">RBSK Team SUW Graph
					  </span>
					</div>
					<div class="tools"> 
					</div>
				  </div>
				  <div class="portlet-body">
				 <div id="chartdiv_saw" class="chartdiv"></div>
				  </div>
				  </div>

				    </div>	

				     <div class="col-md-6">
				    <div class="portlet light bordered">
				  <div class="portlet-title">
					<div class="caption font-green">
					  <i class="fa fa-location-arrow font-green">
					  </i>
					  <span class="caption-subject bold uppercase">Blockwise SUW Graph
					  </span>
					</div>
					<div class="tools"> 
					</div>
				  </div>
				  <div class="portlet-body">
				 <div id="chartdiv_saw_block" class="chartdiv"></div>
				  </div>
				  </div>

				    </div>	

				  </div>
				  <div class="row">
				  <div class="col-md-6">
				<div class="portlet light bordered">
				  <div class="portlet-title">
					<div class="caption font-green">
					  <i class="fa fa-location-arrow font-green">
					  </i>
					  <span class="caption-subject bold uppercase">RBSK Team Graph
					  </span>
					</div>
					<div class="tools"> 
					</div>
				  </div>
				  <div class="portlet-body">
				 <div id="chartdiv2" class="chartdiv"></div>
				  </div>
				  </div>
				  </div>
				  </div>


		
					

<style>
.dataTables_filter {
  float: right;
}
.btn.btn-outline.dark {
  margin-right: 5px;
}
.dataTables_info {
    margin-top: 20px;
}
.chartdiv {
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
	  "color": "#DC143C",
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
    "enabled": true
  }
} );

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
var chart = AmCharts.makeChart( "chartdiv2", {
  "type": "serial",
  "theme": "light",
  "dataProvider": <?php echo json_encode($children_count); ?>,
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
    "valueField": "count"
  } ],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "name",
  "categoryAxis": {
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 20,
	"title":"RBSK Team Graph"
  },
  "export": {
    "enabled": true
  }
} );

// =================== RBSK TEAMWISE GRAPH ========================

var chart = AmCharts.makeChart("chartdiv3", {
    "type": "serial",
	"theme": "light",
	
    "legend": {
        "horizontalGap": 10,
        "maxColumns": 1,
        "position": "right",
		"useGraphSettings": true,
		"markerSize": 10
    },
    "dataProvider":  <?php echo json_encode($team_data); ?>
    ,
    "valueAxes": [{
        "stackType": "regular",
        "axisAlpha": 0.3,
        "gridAlpha": 0
    }],
    "graphs": 
    [{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px;'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "-1SD",
        "type": "column",
        "fillColors":"#008000",
        "valueField": "1sd"
    },{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "-2SD",
        "type": "column",
        "backgroundColor":"#000000",
        "fillColors":"#ffff00",
        "valueField": "2sd"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "-3SD",
        "type": "column",
        "fillColors":"#DC143C",
        "valueField": "3sd"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "-4SD",
        "type": "column",
        "fillColors":"#FF0000",
        "valueField": "4sd"
    }],
    "categoryField": "team_name",
    "categoryAxis": {
        "gridPosition": "start",
        "axisAlpha": 0,
        "gridAlpha": 0,
        "position": "left"
    },
    "export": {
    	"enabled": true
     }

});

// =================== BLOCKWISE SAM GRAPH ========================

var chart = AmCharts.makeChart("chartdiv4", {
    "type": "serial",
	"theme": "light",
    "legend": {
        "horizontalGap": 10,
        "maxColumns": 1,
        "position": "right",
		"useGraphSettings": true,
		"markerSize": 10
    },
    "dataProvider":  <?php echo json_encode($block_chart_data); ?>
    ,
    "valueAxes": [{
        "stackType": "regular",
        "axisAlpha": 0.3,
        "gridAlpha": 0
    }],
    "graphs": 
    [{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "-1SD",
        "type": "column",
		"fillColors":"#008000",
        "valueField": "1sd"
    },{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "-2SD",
        "type": "column",
		"fillColors":"#ffff00",
        "valueField": "2sd"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "-3SD",
        "type": "column",
		"fillColors":"#DC143C",
        "valueField": "3sd"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "-3SD",
        "type": "column",
		"fillColors":"#FF0000",
        "valueField": "4sd"
    }],
    "categoryField": "block_name",
    "categoryAxis": {
        "gridPosition": "start",
        "axisAlpha": 0,
        "gridAlpha": 0,
        "position": "left",
        "labelRotation": 60
    },
    "export": {
    	"enabled": true
     }

});

/*=========================Start Saw graphs ======================*/

var chart = AmCharts.makeChart("chartdiv_saw", {
    "type": "serial",
	"theme": "light",
	
    "legend": {
        "horizontalGap": 10,
        "maxColumns": 1,
        "position": "right",
		"useGraphSettings": true,
		"markerSize": 10
    },
    "dataProvider":  <?php echo json_encode($team_data_saw); ?>
    ,
    "valueAxes": [{
        "stackType": "regular",
        "axisAlpha": 0.3,
        "gridAlpha": 0
    }],
    "graphs": 
    [{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px;'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "SUW",
        "type": "column",
		"fillColors":"#DC143C",
        "valueField": "suw"
    },{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "MUW",
        "type": "column",
		"backgroundColor":"#000000",
        "fillColors":"#ffff00",
        "valueField": "muw"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "NORMAL",
        "type": "column",
        "fillColors":"#008000",
        "valueField": "normal"
    }],
    "categoryField": "team_name",
    "categoryAxis": {
        "gridPosition": "start",
        "axisAlpha": 0,
        "gridAlpha": 0,
        "position": "left",
        "labelRotation": 60
    },
    "export": {
    	"enabled": true
     }

});

// =================== BLOCKWISE SAW GRAPH ========================

var chart = AmCharts.makeChart("chartdiv_saw_block", {
    "type": "serial",
	"theme": "light",
    "legend": {
        "horizontalGap": 10,
        "maxColumns": 1,
        "position": "right",
		"useGraphSettings": true,
		"markerSize": 10
    },
    "dataProvider":  <?php echo json_encode($block_saw_chart_data); ?>
    ,
    "valueAxes": [{
        "stackType": "regular",
        "axisAlpha": 0.3,
        "gridAlpha": 0
    }],
    "graphs": 
    [{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "SUW",
        "type": "column",
        "fillColors":"#DC143C",
        "valueField": "suw"
    },{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "MUW",
        "type": "column",
        "fillColors":"#ffff00",
        "valueField": "muw"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "NORMAL",
        "type": "column",
        "fillColors":"#008000",
        "valueField": "normal"
    }],
    "categoryField": "block_name",
    "categoryAxis": {
        "gridPosition": "start",
        "axisAlpha": 0,
        "gridAlpha": 0,
        "position": "left",
        "labelRotation": 60
    },
    "export": {
    	"enabled": true
     }

});
/*=========================End Saw graphs ======================*/
setTimeout(function(){
	$('[title="JavaScript charts"]').hide()
 
}, 1000);


</script>


