<?php

namespace JunMy\Frontend\Controllers;

use JunMy\Models\Users;
use JunMy\Models\Insuran;

class Prints extends ControllerBase {
	
	
	public function initialize() {
		$this->tag->setTitle('iPrint');
		parent::initialize();  
	}
	
	public function indexAction() {
		parent::pageProtect();
		$offset = mt_rand(0, 1000);
		$key = 'iprint_index_'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    $this->view->setVar('users', $this->get_user($_SESSION['junauth']['id'])); 
			 
		}
		 
		$this->view->cache(array("key" => $key));
	}
	
	/*
	*  View MY PROFILE
	*  Return BOOLEAN
	*/	
	private function get_user($id) {
	    $phql = "SELECT * FROM JunMy\Models\Users WHERE id = '$id' LIMIT 1";
		$rows = $this->modelsManager->executeQuery($phql);
		//$this->view->since = date('j F, Y', strtotime($rows['users']['created']));
		foreach($rows as $key => $row) {
			$this->due = $key['created'];
		}
		return $rows;
	}
}