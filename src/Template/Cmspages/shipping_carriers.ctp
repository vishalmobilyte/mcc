<!-- END PAGE HEADER-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?= HTTP_ROOT.'users/dashboard'; ?>">Dashboard</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Shipping carrier management</span>
		</li>
	</ul>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="fa fa-truck"></i>
                    <span class="caption-subject bold uppercase"> Shipping carrier management</span>
                </div>
                <div class="list-inline mb-0 pull-right">
					<a href="<?php echo HTTP_ROOT; ?>cmspages/add-shipping-carrier" class="nav-link ">
						<button id="sample_editable_1_new" class="btn sbold green"> Add new
							<i class="fa fa-plus"></i>
						</button>
					</a>
				</div>
            </div> 
            <div class="portlet-body">
                <div class="portlet light bordered">
                
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="commonDatatable">
                            <thead>
                                <tr>
                                    <th class="all">Sr. no</th>
                                    <th class="all">Carrier name</th>
                                    <th class="min-phone-l">Phone</th>
                                    <th class="none">Created</th>
                                    <th class="none">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $i=1;
                            foreach ($carries as $carrier): ?>
                            <tr>
                                <td class="text-center"><?= $this->Number->format($i) ?></td>
                                <td><?= $carrier->carrier_name ?></td>
                                <td><?php if(!empty($carrier->phone)) {
                                          echo ($carrier->country_code != "") ?("+".$carrier->country_code."-".$carrier->phone):$carrier->phone; 
                                   } ?>
                                </td>
                                <td><?= !empty($carrier->created) ? (date('Y-m-d', strtotime( $carrier->created ) )):"" ?></td>
                                <td class="actions">
                                        <?php  
                                        if ( $carrier->status == 1 ) 
                                        {
                                            echo $this->Form->postLink(__('<i class="fa fa-check-square-o text-green" aria-hidden="true"></i>'), ['action' => 'changeStatus', $carrier->id, 'off','users','drivers-listing'], ['title' => 'Active', 'escape' => false, 'class' => 'system_user', 'confirm' => __('Are you sure you want to deactivate {0}?', ucfirst( $carrier->carrier_name ) )]); 
                                        }
                                        else
                                        {
                                            echo $this->Form->postLink(__('<i class="fa fa-check-square text-danger" aria-hidden="true"></i>'), ['action' => 'changeStatus', $carrier->id, 'on','users','drivers-listing'], ['title' => 'Inactive', 'escape' => false, 'class' => 'system_user', 'confirm' => __('Are you sure you want to activate {0}?', ucfirst( $carrier->carrier_name ) )]); 
                                        }
                                        ?>
                                        <?= $this->Html->link(__('<i class="fa fa-pencil font-dark" aria-hidden="true"></i>'), ['action' => 'edit-shipping-carrier', base64_encode(convert_uuencode($carrier->id))],['title' => 'Edit', 'escape' => false, 'class'=> 'system_editIcon'] ) ?>
                                </td>
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
<!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
