<?php
// src/Model/Table/ArticlesTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CirclesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
       //  $this->hasMany('Blocks');
         $this->hasMany('Anganwadis');

         $this->belongsTo('Blocks', [
                       'foreignKey' => 'block_id'
                    ]);

    }


    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('name');

        return $validator;
    }
   
}