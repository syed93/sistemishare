<?php

namespace JunMy\Models;

class Images extends \Phalcon\Mvc\Model
{

	public $post_id;

	public $name;
    
	public function getSource()
	{
		return 'images';
	}

	public function initialize()
	{
		$this->hasMany('post_id', 'JunMy\Models\Posts', 'id');		
	}

}
