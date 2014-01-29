<?php

namespace JunMy\Frontend\Controllers;

use JunMy\Models\Users;
use JunMy\Components\Pagination\Pagination;

class TransactionsController extends Controllerbase {
	
	public $paginationUrl;
	
	public $wallet;
	
	public function initialize() {
		$this->tag->setTitle('Transaction histories');
		parent::initialize();
	}
	
	public function historiesAction() {
		if(!$this->session->get('jun_user_auth')) {
	        $this->flash->error('Please login to access members area');
			return $this->response->redirect('users/login');
		} else {
			session_regenerate_id();
			$offset = mt_rand(0, 958695);
			$key = 'userlogin'.$offset;
			$exists = $this->view->getCache()->exists($key);
			if (!$exists) {
			    
				$this->view->setVar('users', $this->get_user($_SESSION['jun_user_auth']['id']));
			    $this->view->setVar('views', $this->view_histories($_SESSION['jun_user_auth']['id']));
			    $this->view->paginationUrl = $this->paginationUrl;
			    $this->view->wallet = $this->view_wallet($_SESSION['jun_user_auth']['id']);
			}
			
			$this->view->cache(array("key" => $key));
		}
	}
	
	private function get_user($id) {
	    $phql = "SELECT * FROM JunMy\Models\Users WHERE id = '$id' LIMIT 1";
		$rows = $this->modelsManager->executeQuery($phql);
		//$this->view->since = date('j F, Y', strtotime($rows['users']['created']));
		foreach($rows as $key => $row) {
			$this->due = $key['created'];
		}
		return $rows;
	}
	
	private function view_histories($id) {
		
	    $records_per_page = 30;
	    $paginations = new Pagination();
        $paginate = (($paginations->get_page() - 1) * $records_per_page);
		$phql = "SELECT
		    *
			FROM JunMy\Models\Transactions 
			WHERE user_id = '$id'
			ORDER BY id ASC";
		$count = $this->modelsManager->executeQuery($phql);	
        $paginations->records(count($count));
        $rows = $this->modelsManager->executeQuery($phql." LIMIT $paginate , $records_per_page");	
        // records per page
        $paginations->records_per_page($records_per_page);
		$this->paginationUrl = $paginations->render();

		return $rows;
	
	}
	
	private function view_wallet($id) {
		$phql = "SELECT amount FROM JunMy\Models\Wallets WHERE user_id = '$id' LIMIT 1";
		$rows = $this->modelsManager->executeQuery($phql);
		//$this->view->since = date('j F, Y', strtotime($rows['users']['created']));
		foreach($rows as $key => $row) {
			return $row['amount'];
		}
		//return $rows;
	}
		
}