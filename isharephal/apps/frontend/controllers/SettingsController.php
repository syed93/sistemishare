<?php

namespace JunMy\Frontend\Controllers;

use JunMy\Models\Users;
use JunMy\Components\Pagination\Pagination;

class SettingsController extends ControllerBase {

    public function initialize() {
		$this->tag->setTitle('User register/login');
		parent::initialize();
	} 
	
	public function profileAction() {
		if(!$this->session->get('jun_user_auth')) {
	        $this->flash->error('Please login to access members area');
			return $this->response->redirect('users/login');
		}
		$offset = mt_rand(0, 1000);
		$key = 'profile'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    $this->view->setVar('users', $this->get_user_profile($_SESSION['jun_user_auth']['id']));
		}
		
		$this->view->cache(array("key" => $key));
	}
	
	public function editAction() {
		if(!$this->session->get('jun_user_auth')) {
	        $this->flash->error('Please login to access members area');
			return $this->response->redirect('users/login');
		}
		$offset = mt_rand(0, 1000);
		$key = 'profile_edit'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    $this->view->setVar('users', $this->get_user_profile($_SESSION['jun_user_auth']['id']));
		}
		
		$this->view->cache(array("key" => $key));
	}
	
	private function get_user_profile($id) {
	    $phql = "SELECT * FROM JunMy\Models\Users WHERE id = '$id' LIMIT 1";
		$rows = $this->modelsManager->executeQuery($phql);
		return $rows;
	}
 
}