<?php

namespace JunMy\Models;

use Phalcon\Mvc\Model\Validator\Email as EmailValidator,
    Phalcon\Mvc\Model\Validator\Numericality as NumericalityValidator;

class Posts extends \Phalcon\Mvc\Model
{   
    public $id, $title, $description, $price, $category_id, $region_id, $created, $user_id, $url, $status;


	public function getSource()
	{
		return 'posts';
	}

	public function initialize()
	{
	}


}
