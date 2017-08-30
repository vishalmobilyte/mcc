<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class NotificationTable extends Table
{   
      
    public function initialize(array $config)
    {
    	parent::initialize($config);
        $this->addBehavior('Timestamp');
                         
                $this->belongsTo('notification', [
                       //'foreignKey' => 'recevier_id'
                    ]);    
       } 
}
?>
