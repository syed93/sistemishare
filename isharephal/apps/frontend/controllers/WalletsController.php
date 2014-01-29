<?php

namespace JunMy\Frontend\Controllers;

use JunMy\Models\Users;

class WalletsController extends ControllerBase {
	
	public $wallet;
	
	public function initialize() {
		$this->tag->setTitle('Ewallet Managements');
		parent::initialize();
	}
	
	public function indexAction() {
		if(!$this->session->get('jun_user_auth')) {
	        $this->flash->error('Please login to access members area');
			return $this->response->redirect('users/login');
		} else {
			session_regenerate_id();
			
			$offset = mt_rand(0, 958695);
			$key = 'wallet_index'.$offset;
			$exists = $this->view->getCache()->exists($key);
			if (!$exists) {
			    
				$this->view->setVar('users', $this->get_user($_SESSION['jun_user_auth']['id']));
				//$this->view->setVar('wallets', $this->get_wallet($_SESSION['jun_user_auth']['id']));
				$this->view->wallet = $this->get_wallet($_SESSION['jun_user_auth']['id']);
				
			}
			
			$this->view->cache(array("key" => $key));
		}
	}
	
	public function addAction() {
		if(!$this->session->get('jun_user_auth')) {
	        $this->flash->error('Please login to access members area');
			return $this->response->redirect('users/login');
		} else {
			session_regenerate_id();
			
			$offset = mt_rand(0, 958695);
			$key = 'wallet_add'.$offset;
			$exists = $this->view->getCache()->exists($key);
			if (!$exists) {
			    $this->view->setVar('users', $this->get_user($_SESSION['jun_user_auth']['id']));
				if($this->request->isGet()) {
					
					if(number_format($this->request->get('add_amount'), 2)) {
					    if($this->request->get('type') == 'manual') {
							// Do form aproval here
							$ord_delcharges = 0;
						} elseif($this->request->get('type') == 'auto') {
							// Do form aproval here
							$ord_delcharges = ($this->request->get('add_amount') / 100) * 2.5;
						} elseif($this->request->get('type') == 'cc') {
							// Do form aproval here
							
							$ord_delcharges = ($this->request->get('add_amount') / 100) * 4;
							
						} else {
						    $this->flash->error('Please select valid Payment Type');
							return $this->response->redirect('wallets/index');
						}
						$ord_mercref = rand(9098762356062, 1235450984694590);
						 
						$total = $this->request->get('add_amount') + $ord_delcharges;
						echo '<label><h4>Amount RM<b>'.number_format($total, 2).'</b></h4><form action="https://webcash.com.my/wcgatewayinit.php" method="post"> 
		                <input type="hidden" name="ord_date" value="'.date('Y-m-d H:i:s').'"> 
		                <input type="hidden" name="ord_totalamt" value="'.number_format($total, 2).'"/>
		                <input type="hidden" name="ord_shipname" value="'.$_SESSION['jun_user_auth']['id'].'">
		                <input type="hidden" name="ord_shipcountry" value="Malaysia"> 
		                <input type="hidden" name="ord_mercref" value="'.$_SESSION['jun_user_auth']['id'].'1610'.time().'"> 
		                <input type="hidden" name="ord_telephone" value="60122865228"> 
		                <input type="hidden" name="ord_email" value="'.$_SESSION['jun_user_auth']['name'].'@ishare.com.my"> 
		                <input type="hidden" name="ord_delcharges" value="0.00"> 
		                <input type="hidden" name="ord_svccharges" value="0.00"> 
		                <input type="hidden" name="ord_mercID" value="80000706">
		                <input type="hidden" name="ord_returnURL" value="http://ishare.com.my"> 
		                <input type="submit" name="submit" value="Pay with Webcash" class="myButton">
		                </form></label>';
					} else {
					    $this->flash->error('Please valid Amount');
						return $this->response->redirect('wallets/index');
					}
				}
				
			}
			
			$this->view->cache(array("key" => $key));
		}
	}
	
	private function get_user($id) {
	    $phql = "SELECT * FROM JunMy\Models\Users WHERE id = '$id' LIMIT 1";
		$rows = $this->modelsManager->executeQuery($phql);
		//$this->view->since = date('j F, Y', strtotime($rows['users']['created']));
		
		return $rows;
	}
	
	private function get_wallet($id) {
	    $phql = "SELECT amount FROM JunMy\Models\Wallets WHERE user_id = '$id' LIMIT 1";
		$rows = $this->modelsManager->executeQuery($phql);
		//$this->view->since = date('j F, Y', strtotime($rows['users']['created']));
		foreach($rows as $row) {
			return number_format($row['amount'], 2);
		}
	
	}
	

	
	
}