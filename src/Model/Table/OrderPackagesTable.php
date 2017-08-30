<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class OrderPackagesTable extends Table
{   
      
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
        
        //$this->hasMany('OrderAssignments', ['foreignKey' => 'id']);
        $this->hasOne('OrderAssignments', [
            'className' => 'OrderAssignments',
            'foreignKey' => 'package_id',
            'bindingKey' => 'id',
            'dependent' => true
        ]);
        $this->hasOne('OrderAssignmentLogs', [
            'className' => 'OrderAssignmentLogs',
            'foreignKey' => 'package_id',
            'bindingKey' => 'id',
            'dependent' => true
        ]);
        $this->belongsTo('Orders');
        
        
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
