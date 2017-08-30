<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class WorkersTable extends Table
{   
      
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
        $this->belongsTo('TypeWorkers', [
                       'foreignKey' => 'type_worker_id'
                    ]);
    $this->belongsTo('Anganwadis', [
                       'foreignKey' => 'anganwadi_id'
                    ]);
    $this->belongsTo('RbskTeams', [
                       'foreignKey' => 'rbsk_team_id'
                    ]);
	
    }
    public function validationDefault(Validator $validator)
    {
         $validator
            ->notEmpty('name', 'Name field is required')
            ->notEmpty('username', 'Username field is required')
            ->add('username', [
                'unique' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'This username already in use'
                ]
            ])
            /*->notEmpty('email', __('Email field is required'))
            ->add('email', 'validFormat', [
                'rule' => 'email',
                'message' => 'Email must be valid'
            ])
            ->add('email', [
                'unique' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'This email already in use'
                ]
            ])*/
            ->notEmpty('phone', __('Phone field is required'))
            /*->add('phone', [
                'unique' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'This phone already in use'
                ]
            ])*/
            ->add('phone',[
                    'numericCheck'=>[
                    'rule'=>'numericCheck',
                    'provider'=>'table',
                    'message'=>'Please enter the numeric value only.'
                     ]
            ])
            ->add('phone', [
                'minLength' => [
                    'rule' => ['minLength', 10],
                    'last' => true,
                    'message' => 'Please enter at least 10 characters.'
                ],
                'maxLength' => [
                    'rule' => ['maxLength', 10],
                    'message' => 'Please enter no more than 10 characters.'
                ]
            ]);
            //->notEmpty('password', 'Password field is required');
            /*->notEmpty('role', 'Role field is required')
            ->add('role', 'inList', [
                'rule' => ['inList', ['2', '3', '4', '5']],
                'message' => 'Please enter a valid role'
            ]);*/
            
            return $validator;
    } 
   
    public function numericCheck($value,$context){
         $output = is_numeric($context['data']['phone']);
        if($output) {
            return true;
        } else {
            return false;
        }
    }
    /*public function initialize(array $config)
    {
        $this->hasOne('Groups', ['foreignKey' => 'owner_id']);
        $this->addBehavior('Timestamp');
    } */  

    public function beforeSave($event, $entity, $options) 
    {
        /*if(empty($this->request->data[$this->alias]['password'])) 
        {
            unset($this->request->data[$this->alias]['password']);
        }*/
    }


    // src/Model/Table/ArticlesTable.php

  
}
?>
