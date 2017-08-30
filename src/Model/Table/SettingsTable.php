<?php
// src/Model/Table/SettingsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class SettingsTable extends Table
{   
      
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
	} 
    public function validationDefault(Validator $validator)
    {
         $validator
            ->notEmpty('site_title', 'This field is required')
            ->notEmpty('site_owner_email', __('This field is required'))
            ->add('site_owner_email', 'validFormat', [
                'rule' => 'email',
                'message' => 'Email must be valid'
            ])
            ->notEmpty('new_user_notification_email', __('This field is required'))
            ->add('new_user_notification_email', 'validFormat', [
                'rule' => 'email',
                'message' => 'Email must be valid'
            ])
            ->notEmpty('input_text_limit', __('This field is required'))
            ->add('input_text_limit',[
                    'numericCheck'=>[
                    'rule'=>'numericCheck',
                    'provider'=>'table',
                    'message'=>'Please enter the numeric value only.'
                     ],
                     'limitBetween'=>[
						'rule'=>'limitBetween',
						'provider'=>'table',
						'message'=>'Please enter the value between 10 to 255 only.'
                     ]
            ])
            ->add('input_text_limit', [
                'minLength' => [
                    'rule' => ['minLength', 2],
                    'last' => true,
                    'message' => 'Please enter at least 2 characters.'
                ],
                'maxLength' => [
                    'rule' => ['maxLength', 255],
                    'message' => 'Please enter no more than 255 characters.'
                ]
            ])
			->notEmpty('otp_message', 'This field is required')
			->notEmpty('login_message', 'This field is required')
			->notEmpty('fedex_access_key', 'This field is required')
			->notEmpty('fedex_password', 'This field is required')
			->notEmpty('fedex_account_number', 'This field is required')
			->notEmpty('fedex_meter_number', 'This field is required')
			->notEmpty('ups_access_code', 'This field is required')
			->notEmpty('ups_user_id', 'This field is required')
			->notEmpty('ups_password', 'This field is required')
			->notEmpty('twilio_sid', 'This field is required')
			->notEmpty('twilio_auth_token', 'This field is required');
            
            
            return $validator;
    }
    
    public function numericCheck($value,$context){
         $output = is_numeric($context['data']['input_text_limit']);
        if($output) {
            return true;
        } else {
            return false;
        }
    }
    public function limitBetween($value,$context){
         
        if($value >=10 && $value <=255) {
            return true;
        } else {
            return false;
        }
    }
}
?>
