<?php

namespace JunMy\Models;
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;

class Users extends \Phalcon\Mvc\Model
{

	public $id, $username, $password, $name, $email, $created_at, $active, $profile_image, $phone, $business_name, $address, $company_info, $nric, $city;

	public function getSource()
	{
		return 'users';
	}

	public function initialize()
	{
		$this->hasMany('id', 'JunMy\Models\Posts', 'post_id');
	}
	
	public function validation()
    {
        $this->validate(new EmailValidator(array(
            'field' => 'email'
        )));
        $this->validate(new UniquenessValidator(array(
            'field' => 'email',
            'message' => 'Sorry, The email was registered by another user'
        )));
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

}
