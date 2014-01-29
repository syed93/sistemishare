<?php

namespace JunMy\Frontend\Controllers;

use JunMy\Models\Users;
use JunMy\Models\Wallets;
use JunMy\Models\Transactions;

class WalletsController extends ControllerBase {
	
	public $wallet;
	
	public $salt_length = 9;
	
	public function initialize() {
		$this->tag->setTitle('iEwallet');
		parent::initialize();
	}
	
	public function indexAction() {
		parent::pageProtect(); 
		// Show form on volt
		$this->view->hideform = 0;
		$hash = $this->passwordHash(date('YmdHis'));
		$this->view->hash = $hash;
		
		$this->view->setVar('users', $this->get_user($_SESSION['junauth']['id']));
		//$this->view->setVar('wallets', $this->get_wallet($_SESSION['jun_user_auth']['id']));
		$this->view->wallet = $this->get_wallet($_SESSION['junauth']['id']);
		
		if(isset($_GET['submit']) && isset($_GET['username']) && isset($_GET['amount'])) {
		    
		    $amount = $_GET['amount'];
		    $username = $_GET['username'];
		    
			if(empty($amount)) {  
				$this->flash->error('Sila masukan amaun');
			} elseif(!number_format($amount, 2)) {
				$this->flash->error('Amaun tidak sah');
			} elseif(strlen($username)< 5 || strlen($username) > 32) {
				$this->flash->error('Username tidak sah');
			} elseif(count($this->get_username($username)) < 1) {
				$this->flash->error('Username tidak wujud');
			} else {
			    $this->view->hideform = 1;
			    $users = Users::findFirst("username='$username'");
			    $wallet = Wallets::findfirst("user_id='$users->id'");
				// Retreive user profile for preview
				$this->flash->error('Adakah anda pasti?');
				
				echo '<form action="" method="get">'; 
				echo '<input type="hidden" name="ref" value="'.$hash.'">';
			    echo '<input type="hidden" name="status" value="'.$users->id.'">';
			    echo '<input type="hidden" name="nt" value="'.$amount.'">';
				echo '<label><p>Username Penerima:</p>'.$users->username.'</label>';
				echo '<label><p>Nama Penerima: </p>'.$users->name.'</label>';
				echo '<label><p>No Pendaftaran: </p>'.$users->reg_number.'</label>';
				echo '<label><p>No Telefon: </p>'.$users->telephone.'</label>';
				echo '<label><p>Baki iWallet: </p>RM'.$wallet->amount.'</label>';
				echo '<label><p>Jumlah iWallet: </p>RM'.number_format($amount, 2).'</label>';
			    echo '<p>&nbsp;</p><input type="submit" name="proceed" value="Batal" class="jun_button"> 
				<input type="submit" name="proceed" value="Teruskan" class="jun_button">';
				echo '</form>';
			}
		}
		
		$this->view->ajaxurl = $this->url->get('ajax/ajaxusername');
		
		if(isset($_GET['ref']) && isset($_GET['status']) && isset($_GET['nt']) && isset($_GET['proceed']) == 'Teruskan') {
		
			$ref = $_GET['ref'];
			$to_user_id = $_GET['status'];
			$wallet_amount = $_GET['nt'];
			
			if(!is_numeric($to_user_id)) {
				$this->flash->error('Id tidak sah');
			} elseif(!is_numeric($wallet_amount)) {
				$this->flash->error('Amaun tidak sah');
			} elseif(strlen($ref) > 80) {
				$this->flash->error('Referal tidak sah');
			} else {
			    $wallet_amount = $wallet_amount;
			    
			    // Add to iWallet
				if($this->add_wallet($to_user_id, $wallet_amount)) {
					if($this->transaction_history('ADC', 'Credited By Administrator', $to_user_id, $wallet_amount, 13, $_SESSION['junauth']['id'])) {
						$this->flash->success('Transaksi telah berjaya');
					} else {
						$this->flash->error('ERROR TR895');
					}
				} else {
					$this->flash->error('ERROR W7895');
				}
			}
			
		}
			 
	}
 
	
	/*
	*  Add iWallet, used on renewAction
	*/
	private function add_wallet($user_id, $amount) {
		$phql = "UPDATE JunMy\Models\Wallets SET 
				amount = amount + '$amount' WHERE user_id = '$user_id'";
		$update = $this->modelsManager->executeQuery($phql);
		if($update) {
		    return true;
		} else {
			return false;
		}
	}
	
	/*
	*  Add transaction history used on update and renew action
	*/
	private function transaction_history($ref, $title, $user_id, $amount, $type, $pic) {
		$hist = new Transactions();
		$hist->user_id = $user_id;
		$hist->title = $title; 
		$hist->amount = $amount;
		$hist->created = date('Y-m-d H:i:s'); 
		$hist->reference = $ref.date('YmdHis').$user_id;
		$hist->type = $type;
		$hist->pic = $pic; // 1 RENEW, 2 BUY IMALL, 3 TRANSFER TO OTHER USER, 4 DONATE, 5 WITHDRAW, 6 COMMISSION, 7 ADD FUND, 8 DEDUCT SMS 0.20, 9 SELL ON IMALL, 10 RECEIVE FROM OTHER USER, 11 BUY COMPANY ITEMS, 12 BUY E PINS, 13 ADMIN CREDIT
		return $hist->save();
	}
	
	private function passwordHash($pwd, $salt = null) {
        if ($salt === null)     {
            $salt = substr(md5(uniqid(rand(), true)), 0, $this->salt_length);
        } else {
            $salt = substr($salt, 0, $this->salt_length);
        }
        return $salt . sha1($pwd . $salt);
    }
	
	public function ajaxusernameAction() {
		$this->view->disable();
		$request = new \Phalcon\Http\Request();
		if($request->isAjax() == true) {
			$term=$_GET["term"];
			
			$phql = "SELECT username FROM JunMy\Models\Users WHERE username like '%$term%' GROUP BY username LIMIT 15";
			$rows = $this->modelsManager->executeQuery($phql);
			//$this->view->since = date('j F, Y', strtotime($rows['users']['created']));
			$json = '[';
	        $first = true;
			foreach($rows as $row) {
				if (!$first) { 
				    $json .=  ','; } else { $first = false; 
				}
	            $json .= '{"value":"'.$row['username'].'"}';
			}  
			$json .= ']';
	        echo $json;	
		}
	}
	
	public function addAction() {
		if(!$this->session->get('junauth')) {
	        $this->flash->error('Please login to access members area');
			return $this->response->redirect('users/login');
		} else {
			session_regenerate_id();
			
			$offset = mt_rand(0, 958695);
			$key = 'transfer_wallet'.$offset;
			$exists = $this->view->getCache()->exists($key);
			if (!$exists) {
			    $this->view->setVar('users', $this->get_user($_SESSION['junauth']['id']));
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
		                <input type="submit" name="submit" value="Pay with Webcash">
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
	
	private function get_username($username) {
	    $phql = "SELECT * FROM JunMy\Models\Users WHERE username = '$username' LIMIT 1";
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