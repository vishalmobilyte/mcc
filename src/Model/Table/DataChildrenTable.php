<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class DataChildrenTable extends Table
{   
      
    public function initialize(array $config)
    {
    	parent::initialize($config);
     //   $this->addBehavior('Timestamp');
                         
              $this->belongsTo('Workers', [
                       'foreignKey' => 'worker_id'
                    ]);   
$this->belongsTo('Anganwadis', [
                       'foreignKey' => 'anganwadi_id'
                    ]);   	

                    $this->hasMany('SamChild',[

                    'foreignKey' =>'data_children_id'       
                      ]);
                   $this->hasMany('SawChild',[

                    'foreignKey' =>'data_children_id'				
                      ]);
                   
		
		
    } 
}
?>
