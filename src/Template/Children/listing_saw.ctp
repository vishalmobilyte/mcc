
<!-- END PAGE HEADER-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?= HTTP_ROOT.'users/dashboard'; ?>">Dashboard</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Child SUW Records</span>
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
                    <span class="caption-subject bold uppercase"> Child SUW Records</span>
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
                                    <th class="all">Age ( Months )</th>
                                    
                                    <th class="all">Weight</th>
                                    <th class="all">Result</th>
                                    <th class="all">Submitted At</th>
                                   
                                   
                           
                                  
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $i=1;
                            $json_array = array();
                            foreach ($saw_data as $saw_dt): 

                                 $json_array[$i]['weight'] = $saw_dt['weight'];
                                 $json_array[$i]['value'] = $saw_dt['age'];

                                ?>
                            <tr>
                                <td class="text-center"><?= $this->Number->format($i) ?></td>
                                <td class="sorting_1 bold"><?= $saw_dt['data_child']['name'] ?></td>
                                <td><?= $saw_dt['age'] ?></td>
                                
                                <td><?= $saw_dt['weight'] ?></td>
                                <td><?= $saw_dt['saw_result_id'] ?></td>
                               
                                
                                <!-- <td><?= @$roles[$saw_dt->role] ?></td> -->
                                <td><?= !empty($saw_dt->created_at) ? (date('M jS, Y', strtotime( $saw_dt->created_at ) )):"" ?></td>
                                 
                               
                               
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
    <div class="col-md-12"><div id="chartdiv_saw"></div></div>
</div>

<!-- Styles -->
<?php  $json_array_reverse = array_reverse($json_array) ?>
<style>
#chartdiv_saw {
    width   : 100%;
    height  : 500px;
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
var chart = AmCharts.makeChart("chartdiv_saw", {
    "type": "serial",
    "theme": "light",
    "marginRight": 40,
    "marginLeft": 40,
    "autoMarginOffset": 20,
    "mouseWheelZoomEnabled":false,
    "dataDateFormat": "YYYY-MM-DD",
    "valueAxes": [{
        "id": "v1",
        "axisAlpha": 0,
        "position": "left",
        "title":"Weight(KG)",
        "ignoreAxisWidth":true
    }],
    "balloon": {
        "borderThickness": 1,
        "shadowAlpha": 0
    },
    "graphs": [{
        "id": "g1",
        "balloon":{
          "drop":true,
          "adjustBorderColor":false,
          "color":"#ffffff"
        },
        "bullet": "round",
        "bulletBorderAlpha": 1,
        "bulletColor": "#FFFFFF",
        "bulletSize": 5,
        "hideBulletsCount": 50,
        "lineThickness": 2,
        "title": "red line",
        "useLineColorForBulletBorder": true,
        "valueField": "weight",
        "type": "smoothedLine",
        //"valueField": "value",
        //"balloonText": "<span style='font-size:18px;'>W:[[weight]],H:[[value]]</span>"
    }
    /*{
        "id": "g2",
        "balloon":{
          "drop":true,
          "adjustBorderColor":false,
          "color":"#00000"
        },
        "bullet": "round",
        "bulletBorderAlpha": 1,
        "bulletColor": "#00000",
        "bulletSize": 5,
        "hideBulletsCount": 50,
        "lineThickness": 2,
        "title": "red line",
        "useLineColorForBulletBorder": true,
        "valueField": "weight",
        "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
    }*/],
   /* "chartScrollbar": {
        "graph": "g1",
        "oppositeAxis":false,
        "offset":30,
        "scrollbarHeight": 80,
        "backgroundAlpha": 0,
        "selectedBackgroundAlpha": 0.1,
        "selectedBackgroundColor": "#888888",
        "graphFillAlpha": 0,
        "graphLineAlpha": 0.5,
        "selectedGraphFillAlpha": 0,
        "selectedGraphLineAlpha": 1,
        "autoGridCount":true,
        "color":"#AAAAAA"
    },*/
    "chartCursor": {
        "pan": false,
        "valueLineEnabled": false,
        "valueLineBalloonEnabled": false,
        "cursorAlpha":1,
        "cursorColor":"#258cbb",
        "limitToGraph":"g1",
        "valueLineAlpha":0.2,
        "valueZoomable":false

    },
    "valueScrollbar":{
      "oppositeAxis":false,
      "offset":50,
      "scrollbarHeight":50
      
    },
    "categoryField": "value",
    "categoryAxis": {
     "dashLength": 1,
     "gridPosition": "start",
     "title":"Age(Months)",
     "labelColorField": "#ffff00",
     },
    "export": {
        "enabled": true
    },
    "dataProvider": <?php echo json_encode(array_values($json_array_reverse)); ?>
});

chart.addListener("rendered", zoomChart);

zoomChart();

function zoomChart() {
    chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
}
</script>