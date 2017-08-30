<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UserDetailsTable extends Table
{   
      
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
      
    } 
    public function validationDefault(Validator $validator)
    {
         $validator
            ->notEmpty('document_title', 'This field is required')
            ->notEmpty('issued_date', 'This field is required')
            ->notEmpty('expiary_date', 'This field is required')
            ->notEmpty('issued_by', 'This field is required')
            ->notEmpty('document_number', 'This field is required')
            ->add('document_number', [
                'unique' => [
                    'rule' => 'validateUnique',
                     'on' => 'create',
                    'provider' => 'table',
                    'message' =>'Document number already in use'
                ]
            ]);
            return $validator;
    }
    
    
    
}
?>
