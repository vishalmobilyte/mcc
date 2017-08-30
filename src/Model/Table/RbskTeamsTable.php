<?php
// src/Model/Table/ArticlesTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class RbskTeamsTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
         $this->hasMany('Anganwadis');
    }


    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('name');

        return $validator;
    }
   
}