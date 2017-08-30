<?php
// src/Model/Table/ArticlesTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class AnganwadisTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
      
        $this->belongsTo('Circles', [
                       'foreignKey' => 'circle_id'
                    ]);
				$this->belongsTo('RbskTeams', [
                       'foreignKey' => 'rbsk_team_id'
                    ]);

        $this->hasMany('data_children', [
             'bindingKey' => 'id',
             'foreignKey' => 'anganwadi_id'
        ]);
        
        $this->belongsTo('Blocks', [
                       'foreignKey' => 'block_id'
                    ]);

    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('name')
            ->notEmpty('awc_code', 'AWC Code field is required')
            ->add('awc_code', [
                'unique' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'This AWC Code already in use'
                ]
            ]);

        return $validator;
    }
   
}