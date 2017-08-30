<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class SawChildTable extends Table
{   
      
    public function initialize(array $config)
    {
    	parent::initialize($config);
     //   $this->addBehavior('Timestamp');
                         
            $this->belongsTo('Workers', [
                       'foreignKey' => 'worker_id'
                    ]);    
		
		  $this->belongsTo('DataChildren',[
                       'foreignKey' => 'data_children_id'
                    
                    ]);
    } 
}
?>
