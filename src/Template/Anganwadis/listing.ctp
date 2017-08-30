
<!-- END PAGE HEADER-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?= HTTP_ROOT.'users/dashboard'; ?>">Dashboard</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Anganwadis</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="fa fa-building-o"></i>
                    <span class="caption-subject bold uppercase"> Anganwadis</span>
                </div>
                 <?php if(($authUser['role'] < 4) ){ ?>
                <div class="list-inline mb-0 pull-right">
                    <a href="<?php echo HTTP_ROOT; ?>anganwadis/add-agw" class="nav-link ">
                        <button id="sample_editable_1_new" class="btn sbold green"> Add new
                            <i class="fa fa-plus"></i>
                        </button>
                    </a>
                </div>
                <?php  } ?>
            </div> 
            <div class="portlet-body">
                <div class="portlet light bordered">
                  
                   <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="commonDatatable">
                            <thead>
                                <tr>
                                    <th class="all">Sr. no</th>
                                     <th class="all">Name</th>
                                    <th class="all">Block</th>
                                    <th class="all">Team</th>
                                    <th class="all">AWC Code</th>
                                    <th class="min-phone-l">AWC Type</th>

                                    <th class="min-tablet"> -1SD </th>
                                    <th class="min-tablet"> -2SD </th>
                                    <th class="min-tablet"> -3SD </th>
                                    <th class="min-tablet"> -4SD </th>
                                    
                                    <th class="min-tablet"> SUW </th>
                                    <th class="min-tablet"> MUW </th>
                                    <th class="min-tablet"> NORMAL </th>

                                    <th class="none">Created Date</th>
                                    <?php if(($authUser['role'] < 4) ){ ?>
                           
                                    <th class="none">Actions</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $i=1;
                            foreach ($aw_data as $anganwadi): 
                             //   print_r($anganwadi); die;
                                ?>
                            <tr>
                                <td class="text-center"><?= $this->Number->format($i) ?></td>
                                <td class="sorting_1 bold"><?= $anganwadi['name'] ?></td>
                                <td><?= $anganwadi['circle']['block']['name'] ?></td>
                                <td><?= $anganwadi['rbsk_team']['name'] ?></td>
                                <td><?= $anganwadi['awc_code'] ?></td>
                                <td>
                                    <?=  $anganwadi['awc_type'] ?>
                                </td>

                                <td><?= isset($anganwadi['Onesd']) ? $anganwadi['Onesd'] : 0 ?></td>
                                <td><?= isset($anganwadi['Twosd']) ? $anganwadi['Twosd'] : 0 ?></td>
                                <td><?= isset($anganwadi['Threesd']) ? $anganwadi['Threesd'] : 0 ?></td>
                                <td><?= isset($anganwadi['Foursd']) ? $anganwadi['Foursd'] : 0 ?></td>
                                
                                <td><?= isset($anganwadi['suw']) ? $anganwadi['suw'] : 0 ?></td>
                                <td><?= isset($anganwadi['muw']) ? $anganwadi['muw'] : 0 ?></td>
                                <td><?= isset($anganwadi['normal']) ? $anganwadi['normal'] : 0 ?></td>
                                
                                
                                <!-- <td><?= @$roles[$anganwadi->role] ?></td> -->
                                <td><?= !empty($anganwadi->created) ? (date('M jS, Y', strtotime( $anganwadi->created ) )):"" ?></td>
                                <?php if(($authUser['role'] < 4) ){ ?>
                                <td class="actions">
                                    <?= $this->Html->link(__('<i class="fa fa-pencil font-dark" aria-hidden="true"></i>'), ['action' => 'edit-agw', base64_encode(convert_uuencode($anganwadi->id))],['title' => 'Edit', 'escape' => false, 'class'=> 'system_editIcon'] ) ?>
                                   
                                    <?= $this->Form->postLink(__('<i class="fa fa-trash-o text-danger" aria-hidden="true"></i>'), ['action' => 'change-delete-status', $anganwadi['id']], ['title' => 'Delete', 'escape' => false, 'class' => 'system_deleteIcon', 'confirm' => __('Are you sure you want to delete {0}?', ucfirst( $anganwadi['name'] ) )]) ?> 
                                </td>
                               <?php } ?>
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
