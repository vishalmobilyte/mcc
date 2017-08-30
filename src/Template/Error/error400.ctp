<?php
use Cake\Core\Configure;
use Cake\Error\Debugger;

$this->layout = 'my_error';

if (Configure::read('debug')):
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error400.ctp');

    $this->start('file');
?>
<?php if (!empty($error->queryString)) : ?>
    <p class="notice">
        <strong>SQL Query: </strong>
        <?= h($error->queryString) ?>
    </p>
<?php endif; ?>
<?php if (!empty($error->params)) : ?>
        <strong>SQL Query Params: </strong>
        <?php Debugger::dump($error->params) ?>
<?php endif; ?>
<?= $this->element('auto_table_warning') ?>
<?php
    if (extension_loaded('xdebug')):
        xdebug_print_function_stack();
    endif;

    $this->end();
endif;
?>


    <div id="block_error">
        <div>
         <h2><?= h($message) ?>. <p class="error">
			<strong><?= __d('cake', 'Error') ?>: </strong>
			<?= __d('cake', 'The requested address {0} was not found on this server.', "<strong>'{$url}'</strong>") ?>
		</p></h2>
        <p>
        It apperrs that Either something went wrong or the page doesn't exist anymore..<br />
        This website is temporarily unable to service your request as it has exceeded it’s resource limit. Please check back shortly.
        </p>
        
        </div>
    </div>

<style>
  html{
  }
  body{
      margin: 0;
      padding: 0;
      background: #e7ecf0;
      font-family: Arial, Helvetica, sans-serif;
  }
  *{
      margin: 0;
      padding: 0;
  }
  p{
      font-size: 12px;
      color: #373737;
      font-family: Arial, Helvetica, sans-serif;
      line-height: 18px;
  }
  p a{
      color: #218bdc;
      font-size: 12px;
      text-decoration: none;
  }
  a{
      outline: none;
  }
  .f-left{
      float:left;
  }
  .f-right{
      float:right;
  }
  .clear{
      clear: both;
      overflow: hidden;
  }
  #block_error{
      max-width: 845px;width:100%;
      min-height: 384px;
      border: 1px solid #cccccc;
      margin: 72px auto 0;
      -moz-border-radius: 4px;
      -webkit-border-radius: 4px;
      border-radius: 4px;
      background: #fff url(<?php echo HTTP_ROOT.'img/'; ?>block.gif) no-repeat 0 51px;
  }
  #block_error div{
      padding: 40px 40px 0 185px
  }
  
  #block_error div h2 {
		color: #218bdc;
		font-size: 24px;
		display: block;
		padding: 0 0 14px 0;
		border-bottom: 1px solid #cccccc;
		margin-bottom: 12px;
		font-weight: normal;
		
	}
	@media (max-width:640px){#block_error div{padding:0 10px;}}
	
</style>
