<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class OrderAssignmentsTable extends Table
{   
      
    public function initialize(array $config)
    {
    	parent::initialize($config);
        $this->addBehavior('Timestamp');
/*
        $this->belongsTo('OrderDetail', [
                        'className' => 'Orders',
                        'foreignKey' => 'order_id'
                    ]);*/
      $this->belongsTo('Orders', [
                        'className' => 'Orders',
                        'foreignKey' => 'order_id'
                    ]);
                    
        $this->belongsTo('OrderPackages', [
                        'className' => 'OrderPackages',
                        'foreignKey' => 'package_id'
                    ]);  

        $this->belongsTo('OrderAssignmentLogs', [
                       'className' => 'OrderAssignmentLogs',
                       'foreignKey' => 'id',
                       'bindingKey' => 'order_assignment_id'
                    ]);

       
		 $this->hasOne('assign_agent_detail', [
				'className' => 'Users',
				'foreignKey' => 'id',
				'bindingKey' => 'assign_to',
				'dependent' => true
			]);  


    } 
}
?>
