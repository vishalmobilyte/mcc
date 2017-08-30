<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class OrderAssignmentLogsTable extends Table
{   
      
    public function initialize(array $config)
    {
    	parent::initialize($config);
        $this->addBehavior('Timestamp');

        $this->belongsTo('OrderAssignments', [
                       'foreignKey' => 'order_assignment_id'
                    ]);
                    
        $this->hasOne('agent_detail', [
            'className' => 'Users',
            'foreignKey' => 'id',
            'bindingKey' => 'assign_by',
            'dependent' => true
        ]);  
        
        $this->hasOne('ShippingCarriers', [
            'className' => 'ShippingCarriers',
            'foreignKey' => 'id',
            'bindingKey' => 'shipping_carrier_id',
            'dependent' => true
        ]);  
        
        $this->hasOne('driver_detail', [
            'className' => 'Users',
            'foreignKey' => 'id',
            'bindingKey' => 'assign_to',
            'dependent' => true
        ]);        
       
     


    } 
}
?>
