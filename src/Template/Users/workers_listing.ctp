<!-- END PAGE HEADER-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?= HTTP_ROOT.'users/dashboard'; ?>">Dashboard</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Workers management</span>
		</li>
	</ul>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-users"></i>
                    <span class="caption-subject bold uppercase"> Workers management</span>
                </div>
                <?php if($authUser['role'] < 4){ ?>

                
                <div class="list-inline mb-0 pull-right">
					<a href="<?php echo HTTP_ROOT; ?>users/add-worker" class="nav-link ">
						<button id="sample_editable_1_new" class="btn sbold green"> Add new
							<i class="fa fa-plus"></i>
						</button>
					</a>
				</div>
                <?php } ?>
            </div> 
            <div class="portlet-body">
                <div class="portlet light bordered">
                  
                   <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="commonDatatable">
                            <thead>
                                <tr>
									<th class="all">Sr. no</th>
                                     <th class="all">Full name</th>
                                    <th class="all">Username</th>
                                    <th class="all">Email</th>
                                    <th class="all">Role</th>
                                    <th class="min-phone-l">Phone</th>
                                    <th class="min-phone-l">Anganwadi/Team</th>
                                    <!-- <th class="min-tablet">Role</th> -->
                                    <?php if(($authUser['role'] == 1) || ($authUser['role'] == 2)){ ?>
                                    <?php } ?>
                                    <th class="none">Created Date</th>
                            <?php if($authUser['role'] < 4){ ?>
                                    <th class="none">Actions</th>
                                      <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $i=1;
                            foreach ($users as $user): 
                               
                                ?>
                            <tr>
                                <td class="text-center"><?= $this->Number->format($i) ?></td>
                                <td class="sorting_1 bold"><?= $user->name ?></td>
                                <td><?= $user->username ?></td>
                                <td><?= $user->email ?></td>
                                <td><?= @$user->type_worker->name ?></td>
                                 <td>
                                    <?php 
                                    if(!empty($user->phone)) {
                                          echo $user->phone; 
                                    }else{
                                        echo "----";
                                    } ?>
                                </td>
                                <td>
									<?php 
									if( !empty($user->rbsk_team->name)) {
                                          echo $user->rbsk_team->name; 
									}else{
										echo $user->anganwadi->name;
									} ?>
                                </td>

                                <!-- <td><?= @$roles[$user->role] ?></td> -->
                                <td><?= !empty($user->created) ? (date('M jS, Y', strtotime( $user->created ) )):"" ?></td>
                               <?php if($authUser['role'] < 4){ ?>
                                <td class="actions">
                          
                            <?= $this->Html->link(__('<i class="fa fa-pencil font-dark" aria-hidden="true"></i>'), ['action' => 'edit-worker', base64_encode(convert_uuencode($user->id))],['title' => 'Edit', 'escape' => false, 'class'=> 'system_editIcon'] ) ?>
                            <?php /* $this->Html->link(__('<i class="fa fa-unlock-alt aria-hidden="true"></i>'), ['action' => 'changePassword','agents-listing', base64_encode(convert_uuencode($user->id))], ['title' => 'Change Password', 'escape' => false]) */ ?> 
                           
                            <?php
                            
                             if ($user->role != 1){ ?>
                                <?= $this->Form->postLink(__('<i class="fa fa-trash-o text-danger " aria-hidden="true"></i>'), ['action' => 'deleteworker', $user->id], ['title' => 'Delete', 'escape' => false, 'class' => 'system_deleteIcon', 'confirm' => __('Are you sure you want to delete {0}?', ucfirst( $user->name ) )]) ?> 
                            <?php } 
                            
                            ?>
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