<!-- END PAGE HEADER-->
<div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="<?= HTTP_ROOT.'users/dashboard'; ?>">Dashboard</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Email template management</span>
                            </li>
                        </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="fa fa-envelope-o font-dark"></i>
                    <span class="caption-subject bold uppercase"> Email templates</span>
                </div>
            </div> 
            <div class="portlet-body">
                <div class="portlet light bordered">
                    <!-- <div class="portlet-title">
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
                    </div> -->
                    <div class="portlet-body">
                     	<?php echo $this->element('adminElements/success_msg');?>
				    	<?php echo $this->element('adminElements/error_msg');?>

                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="commonDatatable1">
                            <thead>
                                <tr>
                                    <th class="all">id</th>
                                    <th class="all">Title</th>
                                    <th class="min-phone-l">Subject</th>
                                    <th class="min-tablet">Alias</th>
                                    <th class="min-tablet"><span class="nobr">Action</span></th>
								</tr>
                            </thead>
                            <tbody>
                               	<?php if(sizeof($emailTemplates) > 0) {
                               
                            ?>
                            <?php 
                            $i=1;
                            foreach($emailTemplates as $template) {  ?>
                            <tr>
                                <td class="text-center"><?= $this->Number->format($i) ?></td>
                                <td><?php echo $template->title; ?></td>
                                <td><?php 
                                         echo $template->subject;
                                ?></td>
                                <td><?php 
                                        echo $template->alias;
                                ?></td>
                                
                                    <td class="actions text-center">

                                           <?= $this->Html->link(__('<i class="fa fa-pencil font-dark" aria-hidden="true"></i>'), ['action' => 'email-template-edit', base64_encode(convert_uuencode($template->id))],['title' => 'Edit', 'escape' => false, 'class'=> 'system_editIcon'] ) ?>
                                    </td>
                            </tr>
                            <?php
                            $i++;  
                            } 
                            } else { ?>
                                <tr class="even pointer">
                                    <td class="noRecords" colspan="3" style=" text-align:center;">No Records Found</td>
                                </tr>
                            <?php } ?>
								
	                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
<!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<style>
.dataTables_filter {
  text-align: right ;
}
</style>
