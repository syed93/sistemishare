<?php 

namespace JunMy\Frontend\Controllers;

use JunMy\Models\Users;
use JunMy\Models\Posts;

class PostordersController extends ControllerBase {
	
	public function initialize() {
		$this->set->setTitle('My Cart');
		parent::initialize();
	}
}