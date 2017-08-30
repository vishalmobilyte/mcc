<?php
// src/Model/Table/OrdersTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class OrdersTable extends Table
{   
      
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');

        $this->hasMany('OrderPackages', ['foreignKey' => 'order_id']);
        $this->hasMany('OrderTracking', ['foreignKey' => 'order_id']);
        $this->hasMany('OrderDetails', ['foreignKey' => 'order_id']);
        $this->hasMany('OrderLocations', ['foreignKey' => 'order_id']);
		$this->hasOne('OrderAssignmentLogs', ['foreignKey' => 'order_id']);
		$this->hasOne('OrderAssignments', ['foreignKey' => 'order_id']);

       $this->hasOne('customer_detail', [
            'className' => 'Users',
            'foreignKey' => 'id',
            'bindingKey' => 'customer_id',
            'dependent' => true
        ]);

    } 
    public function validationDefault(Validator $validator)
    {
        
    }
    public function beforeSave($event, $entity, $options) 
    {
        /*if(empty($this->request->data[$this->alias]['password'])) 
        {
            unset($this->request->data[$this->alias]['password']);
        }*/
    }


    // src/Model/Table/ArticlesTable.php

    /*public function isOwnedBy($userId, $parentId)
    {
        return $this->exists(['id' => $userId, 'parent_id' => $parentId]);
    }*/
}
?>
