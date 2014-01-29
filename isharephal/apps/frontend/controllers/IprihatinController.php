<?php

namespace JunMy\Frontend\Controllers;

use JunMy\Models\Users; 
use JunMy\Components\Pagination\Pagination; 
use JunMy\Models\Iprihatin;  
use JunMy\Models\Iprihatinphoto;
use JunMy\Models\Wallets;
use JunMy\Models\Transactions; 

class IprihatinController extends ControllerBase {
	
	public $paginationUrl;
	
	public $get_date;
	
	public $current_url;
	
	public function initialize() {
		$this->tag->setTitle('iPrihatin');
		parent::initialize();
	}
	
	public function indexAction() {
		parent::pageProtect(); 
		$offset = mt_rand(0, 41000);
		$key = 'iprihatin_index_'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    $this->view->setVar('users', $this->get_user($_SESSION['jun_user_auth']['id'])); 
			$this->view->setVar('iprihatins', $this->view_all_post());
		    $this->view->get_date = $this->get_date;
			$this->view->paginationUrl = $this->paginationUrl;
		}
		 
		$this->view->cache(array("key" => $key));
		
	}
	
	public function viewAction() {
		parent::pageProtect(); 
		$offset = mt_rand(0, 251000);
		$key = 'iprihatin_view_'.$this->dispatcher->getParam('slug').$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    $this->view->iprihatin_upload_dir = $this->iprihatin_image_dir();
		    $this->view->setVar('users', $this->get_user($_SESSION['jun_user_auth']['id'])); 
			$this->view->setVar('iprihatins', $this->view_post($this->dispatcher->getParam('slug'))); 
			$this->view->get_date = $this->get_date;
			$this->view->current_url =  basename($_SERVER['REQUEST_URI']);
		}
		$this->view->mywallet = number_format($this->get_wallet($_SESSION['jun_user_auth']['id']), 2);
		if($this->request->isPost()) {
			if(!is_numeric($this->request->getPost('donate_amount'))) {
				$this->flash->error('Sila masukan amaun yang sah');
			} else {
			    $this->view->mywallet = number_format($this->get_wallet($_SESSION['jun_user_auth']['id']), 2);
			    $amount = $this->request->getPost('donate_amount');
			    $iprihatin_id = $this->request->getPost('iprihatin_id');
			    $this->donate($iprihatin_id, $amount, $_SESSION['jun_user_auth']['id']);
			}
		}
		$this->view->cache(array("key" => $key));
	} 
	
	/*
	*  View all post
	*  Return BOOLEAN
	*/	
	private function view_all_post() {
		$records_per_page = 25;
	    $paginations = new Pagination();
        $paginate = (($paginations->get_page() - 1) * $records_per_page);
		$phql = "SELECT
		    id, title, body, created, slug, amount, type, pic
			FROM JunMy\Models\Iprihatin 
			
			ORDER BY id DESC";
		$count = $this->modelsManager->executeQuery($phql);	
		if(count($count) > 0) {
			$paginations->records(count($count));
	        $rows = $this->modelsManager->executeQuery($phql." LIMIT $paginate , $records_per_page");	
	        // records per page
	        $paginations->records_per_page($records_per_page);
			$this->paginationUrl = $paginations->render();
	        
			return $rows;	
		} else {
			$this->flash->error('Tiada rekod dalam iPrihatin');
		}
        
	}
	
	/*
	*  View each post, used on viewAction
	*  Return BOOLEAN
	*/	
	private function view_post($slug) {
	    $phql = "SELECT 
			i.id AS id, i.title AS title, i.body AS body, i.created AS created, i.slug AS slug, 
			i.amount AS amount, i.type AS type, i.pic AS pic,
			p.image_name AS image
		FROM JunMy\Models\Iprihatin AS i
		LEFT JOIN JunMy\Models\Iprihatinphoto AS p on(p.iprihatin_id = i.id) 
		WHERE i.slug LIKE '$slug' LIMIT 1";
		$rows = $this->modelsManager->executeQuery($phql);
	    foreach($rows as $row) {
			$this->get_date = date("j F Y, g:i a", strtotime($row['created']));
		}
		return $rows;
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
	
	private function get_wallet($user_id) {
		$wallet = Wallets::findFirst("user_id = $user_id");
		return $wallet->amount;
	}
	/*
	*  iPrihatin update and deduct iwallet
	*/
	private function donate($id, $amount, $user_id) {
		$wallet = Wallets::findFirst("user_id = $user_id");
		if($wallet->amount < $amount) {
			$this->flash->error('Baki iWallet anda tidak mencukupi');
		} else {
		 
		    //Deduct iWallet
			$balance = $wallet->amount - $amount;
			$wallet->amount = $balance;
			if($wallet->save()) {
			    // Update amount to iPrihatin post
			    $iprihatin = Iprihatin::findFirst("id = $id");
			    $iprihatin_amount = $iprihatin->amount + $amount;
				$iprihatin->amount = $iprihatin_amount;
				
				// Add amount to iPrihatin post
				if($iprihatin->save()) {
				    
				    // Transaction history
				    if($this->transaction_history('IPDNT', 'Sumbangan iPrihatin', $user_id, $amount, 4, $user_id)) {
						$this->flash->success('Terima kasih, Sumbangan iPrihatin telah berjaya');
					} else {
						$this->flash->error('Error THIP454, Please contact Azrul haris');
					}
					
				} else {
					foreach ($iprihatin->getMessages() as $message) {
		                $this->flash->error((string) $message);
		            }
				}
				
			} else {
				foreach ($wallet->getMessages() as $message) {
	                $this->flash->error((string) $message);
	            }
			}
		}
	}
	
	/*
	*  Add transaction history used on update and renew action
	*/
	private function transaction_history($ref, $title, $user_id, $amount, $type, $pic) {
		$hist = new Transactions();
		$hist->user_id = $user_id;
		$hist->title = $title; 
		$hist->amount = '-'.$amount;
		$hist->created = date('Y-m-d H:i:s'); 
		$hist->reference = $ref.date('YmdHis').$user_id;
		$hist->type = $type;
		$hist->pic =  $pic;// 1 RENEW, 2 BUY IMALL, 3 TRANSFER TO OTHER USER, 4 DONATE, 5 WITHDRAW, 6 COMMISSION, 7 ADD FUND, 8 DEDUCT SMS 0.20, 9 SELL ON IMALL, 10 RECEIVE FROM OTHER USER, 11 BUY COMPANY ITEMS, 12 BUY E PINS,
		return $hist->save();
	}
	 
}