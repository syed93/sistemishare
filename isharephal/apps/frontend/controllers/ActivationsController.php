<?php

namespace JunMy\Frontend\Controllers;

use JunMy\Models\Users; 
use JunMy\Components\Pagination\Pagination;
use JunMy\Models\Epins; 

class ActivationsController extends ControllerBase {
	
	public function initialize() {
		$this->tag->setTitle('iKomuniti activation');
		parent::initialize();
	}
	
	
	public function indexAction() {
		parent::pageProtect(); 
		$offset = mt_rand(0, 1000);
		$key = 'activations_index_'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    $this->view->setVar('users', $this->get_user($_SESSION['jun_user_auth']['id']));
		    if(count($this->view_user($_SESSION['jun_user_auth']['username'])) > 0) {
				
			} else {
				$this->flash->error('Tiada iKomuniti yang perlu diaktifkan');
			}
			$this->view->setVar('views', $this->view_user($_SESSION['jun_user_auth']['username']));
		    
			$this->view->paginationUrl = $this->paginationUrl;
		}
		
		if(isset($_GET['ref']) && isset($_GET['activate']) && isset($_GET['ntsv'])) {
		    $downline_id = $_GET['ntsv'];
		    if(is_numeric($downline_id)) {
				$this->check_epin($_SESSION['jun_user_auth']['id'], $downline_id);
			} 	
		} 
		$this->view->cache(array("key" => $key));
	}
	
	/*
	*  Activate member used epin
	*/	
	private function check_epin($user_id, $used_user_id) {
		$phql = "SELECT id FROM JunMy\Models\Epins WHERE user_id = '$user_id' ORDER BY id ASC LIMIT 1";
		$rows = $this->modelsManager->executeQuery($phql);
		if(count($rows) > 0) {
			$update = "UPDATE JunMy\Models\Epins SET 
		               used_user_id = '$used_user_id' WHERE user_id = '$user_id' LIMIT 1";
		    $return = $this->modelsManager->executeQuery($update);
		    if($return) {
		        if($this->activate_user($used_user_id)) {
					$this->flash->success('iKomuniti telah diaktifkan');
				} else {
					$this->flash->error('Error E067 - Sila hubungi bahagian teknikal');
				}
			} else {
				$this->flash->error('Error E068 - Sila hubungi bahagian teknikal');
			}
		} else {
			$this->flash->error('Anda tidak mempunyai iPin untuk pengaktifan iKomuniti');
		}
	}
	
	/*
	*  Update users column 'verified' from 0 to 1
	*  Return BOOLEAN
	*/	
	private function activate_user($id) {	
	    $phql = "UPDATE JunMy\Models\Users SET 
		verified = '1' WHERE id = '$id'";
		$update = $this->modelsManager->executeQuery($phql);
		if($update) {
		    return true;
		}
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
	
	/*
	*  View all downline
	*  Return BOOLEAN
	*/
	private function view_user($username) {
		
	    $records_per_page = 30;
	    $paginations = new Pagination();
        $paginate = (($paginations->get_page() - 1) * $records_per_page);
		$phql = "SELECT
		    *
			FROM JunMy\Models\Users 
			WHERE username_sponsor='$username' AND verified = '0'
			ORDER BY id DESC";
		$count = $this->modelsManager->executeQuery($phql);	
        $paginations->records(count($count));
        $rows = $this->modelsManager->executeQuery($phql." LIMIT $paginate , $records_per_page");	
        // records per page
        $paginations->records_per_page($records_per_page);
		$this->paginationUrl = $paginations->render();

		return $rows;
	
	}
}