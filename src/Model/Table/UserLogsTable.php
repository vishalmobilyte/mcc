<?php
// src/Model/Table/UserLogsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UserLogsTable extends Table
{   
      
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');

        $this->hasOne('sent_from', [
            'className' => 'Users',
            'foreignKey' => 'id',
            'bindingKey' => 'notification_from'
        ]);
        
        $this->hasOne('sent_to', [
            'className' => 'Users',
            'foreignKey' => 'id',
            'bindingKey' => 'notification_to'
        ]);
        
         $this->belongsTo('Orders', [
					'className' => 'Orders',
					'foreignKey' => 'order_id'
				]);
                    

    } 
    
}
?>
