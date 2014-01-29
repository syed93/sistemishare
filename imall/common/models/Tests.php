<?php

namespace JunMy\Models;

use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;

class Tests extends \Phalcon\Mvc\Model
{
//albums
	public $id;

	public $title;
	
	public $description;
	
	public $category_id;
	
	public $region_id;

	public function getSource()
	{
		return 'tests';
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
        $this->validate(new UniquenessValidator(array(
            'field' => 'username',
            'message' => 'Sorry, That username is already taken'
        )));
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

	public function initialize()
	{
		$this->belongsTo('region_id', 'JunMy\Models\Regions', 'id');
		$this->belongsTo('category_id', 'JunMy\Models\Categories', 'id');
		$this->hasMany('post_id', 'JunMy\Models\Images', 'id');
	}

}
