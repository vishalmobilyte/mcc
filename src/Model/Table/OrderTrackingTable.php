<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class OrderTrackingTable extends Table
{   
      
    public function initialize(array $config)
    {
    	parent::initialize($config);
        $this->addBehavior('Timestamp');
                         
        $this->belongsTo('OrderPackages', [
                        'className' => 'OrderPackages',
                        'foreignKey' => 'package_id'
                    ]);  
        $this->belongsTo('Users', [
                        'className' => 'Users',
                        'foreignKey' => 'user_id'
                    ]);              
		
		
    } 
}
?>
