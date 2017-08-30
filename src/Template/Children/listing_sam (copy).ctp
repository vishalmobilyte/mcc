
<!-- END PAGE HEADER-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?= HTTP_ROOT.'users/dashboard'; ?>">Dashboard</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Child SAM Records</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-6">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="fa fa-user-secret"></i>
                    <span class="caption-subject bold uppercase"> Child SAM Records</span>
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
                                    <th class="all">Age</th>
                                    <th class="all">Height</th>
                                    <th class="all">Weight</th>
                                    <th class="all">Worker</th>
                                    <th class="all">Result</th>
                                    <th class="all">Submitted At</th>
                                   
                                   
                           
                                  
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $i=1;
                            foreach ($sam_data as $sam_dt): 
                              //  print_r($sam_dt); die;
                                ?>
                            <tr>
                                <td class="text-center"><?= $this->Number->format($i) ?></td>
                                <td class="sorting_1 bold"><?= $sam_dt['data_child']['name'] ?></td>
                                <td><?= $sam_dt['data_child']['age'] ?></td>
                                <td><?= $sam_dt['height'] ?></td>
                                <td><?= $sam_dt['weight'] ?></td>
                                <td><?= $sam_dt['worker']['name'] ?></td>
                                <td>-<?= $sam_dt['sam_result_id'] ?></td>
                               
                                
                                <!-- <td><?= @$roles[$sam_dt->role] ?></td> -->
                                <td><?= !empty($sam_dt->created_at) ? (date('M jS, Y', strtotime( $sam_dt->created_at ) )):"" ?></td>
                                 
                               
                               
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
</div>
