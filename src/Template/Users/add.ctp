<!-- src/Template/Users/add.ctp -->

<div class="">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h4>Add Users<small></small></h4>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php echo $this->Form->create($user,[
							'url' 		=> ['controller' => 'Users', 'action' => 'add'],
							'class'		=>'form-horizontal form-label-left',
							'id'		=>'usersAdd',
							'enctype'	=>'multipart/form-data',
							'novalidate'=>'novalidate',
              'autocomplete'=>'off'
							 // 'autocomplete'=>'off',
									]) ?>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        	Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 
                                echo $this->Form->input('name',[
                                   'label' => false,
                                   'required' => true,
                                   'class'=>'form-control col-md-7 col-xs-12']);
                                ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        	Username<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 
                                echo $this->Form->input('username',[
                                   'label' => false,
                                   'required' => true,
                                   // 'error'	=> false,
                                   // 'format'=>array('after', 'input'),
                                   'class'=>'form-control col-md-7 col-xs-12']);
                                ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        	Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 
                                echo $this->Form->input('email',[
                                   'label' => false,
                                   'required' => true,
                                   'class'=>'form-control col-md-7 col-xs-12']);
                                ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                          Phone <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 
                                echo $this->Form->input('phone',[
                                   'label' => false,
                                   'required' => true,
                                   'class'=>'form-control col-md-7 col-xs-12']);
                                ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        	Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 
                                echo $this->Form->input('password',[
                                   'label' => false,
                                   'type'	=> 'password',
                                   'required' => false,
                                   'id' => 'password',
                                   'class'=>'form-control col-md-7 col-xs-12']);
                                ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        	Confirm Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 
                                echo $this->Form->input('passwordConfirm',[
                                   'label' => false,
                                   'required' => false,
                                   'type'	=> 'password',
                                   'class'=>'form-control col-md-7 col-xs-12']);
                                ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        	Role <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 
                                echo $this->Form->input('role',[
                                   'label' => false,
                                   'required' => true,
                                   'class'=>'form-control col-md-7 col-xs-12',
                                   'options' => $roles
                                   ]);
                                ?>
                        </div>
                    </div>
                    <hr />
                    <br />
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="button"  class="btn btn-primary" onclick="window.history.go(-1);"  >Cancel</button>
                            <button id="send" type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                    <?php echo $this->form->end(); ?>
                    <!-- end form -->
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .ct{
    display:none;
    }
</style>