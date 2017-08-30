<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> System Users</span>
                </div>
            </div> 
            <div class="portlet-body">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <div class="btn-group">
                                <a href="<?php echo HTTP_ROOT; ?>users/add" class="nav-link ">
                                    <button id="sample_editable_1_new" class="btn sbold green"> Add New
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="commonDatatable">
                            <thead>
                                <tr>
                                    <th class="all">Id</th>
                                    <th class="all">Name</th>
                                    <th class="min-phone-l">Email</th>
                                    <th class="min-tablet">Role</th>
                                    <?php if(($authUser['role'] == 1) || ($authUser['role'] == 2)){ ?>
                                    <?php } ?>
                                    <th class="none">Created</th>
                                    <th class="none">Modified</th>
                                    <th class="none">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $this->Number->format($user->id) ?></td>
                                <td><?= $user->name ?></td>
                                <td><?= $user->email ?></td>
                                <td><?= @$roles[$user->role] ?></td>
                                <td><?= date('Y-m-d', strtotime( $user->created ) ) ?></td>
                                <td><?= date('Y-m-d', strtotime( $user->modified ) ) ?></td>
                                <td class="actions">
                            <?php  
                            if ( $user->status == 1 ) 
                            {
                                echo $this->Form->postLink(__('<i class="fa fa-user text-green" aria-hidden="true"></i>'), ['action' => 'changeStatus', $user->id, 'off'], ['title' => 'Active', 'escape' => false, 'class' => 'system_user', 'confirm' => __('Are you sure you want to deactivate {0}?', ucfirst( $user->name ) )]); 
                            }
                            else
                            {
                                echo $this->Form->postLink(__('<i class="fa fa-user-times text-danger" aria-hidden="true"></i>'), ['action' => 'changeStatus', $user->id, 'on'], ['title' => 'Inactive', 'escape' => false, 'class' => 'system_user', 'confirm' => __('Are you sure you want to activate {0}?', ucfirst( $user->name ) )]); 
                            }
                            ?>
                            <?= $this->Html->link(__('<i class="fa fa-pencil font-dark" aria-hidden="true"></i>'), ['action' => 'edit', $user->id],['title' => 'Edit', 'escape' => false, 'class'=> 'system_editIcon'] ) ?>
                            <?= $this->Html->link(__('<i class="fa fa-unlock-alt aria-hidden="true"></i>'), ['action' => 'changePassword', $user->id], ['title' => 'Change Password', 'escape' => false]) ?> 
                            <?php
                            /***
                             if ($user->role != 1){ ?>
                                <?= $this->Form->postLink(__('<i class="fa fa-trash-o text-danger pull-right" aria-hidden="true"></i>'), ['action' => 'delete', $user->id], ['title' => 'Delete', 'escape' => false, 'class' => 'system_deleteIcon', 'confirm' => __('Are you sure you want to delete {0}?', ucfirst( $user->name ) )]) ?> 
                            <?php } 
                            /***/
                            ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
<!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>