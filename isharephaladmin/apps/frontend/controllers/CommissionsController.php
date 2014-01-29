<?php

namespace JunMy\Frontend\Controllers;
use JunMy\Models\Users;
use JunMy\Models\Notifications;
use JunMy\Models\Transactions;

	
class CommissionsController extends ControllerBase {
 
    
    public function initialize()
    {
        //Set the document title
        $this->tag->setTitle('Insurance Managements');
        parent::initialize();
    }

	public function payoutAction() {
		if(!$this->session->get('junauth')) {
	        $this->flash->error('Please login to access members area');
			return $this->response->redirect('users/login');
		}
	
		
		
		$offset = mt_rand(0, 1000);
		$key = 'Commission_index'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		   	if(filter_input(INPUT_GET, 'user_id', FILTER_VALIDATE_INT) && isset($_GET['ins_amount'])) {
				if($this->for_level(filter_input(INPUT_GET, 'user_id', FILTER_VALIDATE_INT), $_GET['ins_amount'])) {
					return $this->response->redirect('insuran/manage');
				} else {
					$this->flash->error('Error Four Level');
				}
			} else {
				$this->flash->error('Not valid url');
			} 
		    
		}
		$this->view->cache(array("key" => $key));
		
	}
	
	private function for_level($user_id, $amount) {
	    //Select join 4 level, retrieve phone for SMS and 
		$phql = "SELECT root.username_sponsor AS root_ref_name,
		                one.id AS one_id, one.username AS one_username, one.telephone AS one_tel,
		                two.id AS two_id, two.username AS two_username, two.telephone AS two_tel,
						tree.id AS tree_id, tree.username AS tree_username, tree.telephone AS tree_tel,
						four.id AS four_id, four.username AS four_username, four.telephone AS four_tel
				FROM JunMy\Models\Users AS root		
				JOIN JunMy\Models\Users AS one ON(one.username = root.username_sponsor)
				JOIN JunMy\Models\Users AS two ON(two.username = one.username_sponsor)
				JOIN JunMy\Models\Users AS tree ON(tree.username = two.username_sponsor)
				JOIN JunMy\Models\Users AS four ON(four.username = tree.username_sponsor)
				WHERE root.id = '$user_id' LIMIT 4";
		$rows = $this->modelsManager->executeQuery($phql);
		foreach($rows as $row) {
		    //echo $row['one_username'] . $row['two_username'] . $row['tree_username'];
			// Update wallets +15
		
			if($amount >= 500) {
				$level_1 = 15;
				$level_2 = 10;
				$level_3 = 5;
				$level_4 = 10;
			} else {
				// Jika insuran bawah 500
				$level_1 = 5;
				$level_2 = 3;
				$level_3 = 2;
				$level_4 = 5;
			}
			
			// Pay 4 level commission
			if($this->update_wallet($row['one_id'], $level_1)) {
				if($this->update_wallet($row['two_id'], $level_2)) {
				    if($this->update_wallet($row['tree_id'], $level_3)) {
				        if($this->update_wallet($row['four_id'], $level_4)) {
				            return true;
			            } else {
							$this->flash->error("Error: 4");
						}
			        } else {
						$this->flash->error("Error: 3");
					}
			    } else {
					$this->flash->error("Error: 2");
				}
			} else {
				$this->flash->error("Error: 1");
			} 
		}
				
	}
	
	/**
	* UPDATE EWALLET BALANCE amount = amount + $amount
	*/
	private function update_wallet($id, $amount) {
		$phql = "UPDATE JunMy\Models\Wallets SET 
				amount = amount + '$amount' WHERE user_id = '$id'";
		$update = $this->modelsManager->executeQuery($phql);
		if($update) {
			return $this->transaction_history($id, $amount);
		} else {
			$this->flash->error("Error: private function update_wallet");
		}
	}

	/**
	* Insert transaction history
	*/
	private function transaction_history($user_id, $amount) {
		$hist = new Transactions();
		$hist->user_id = $user_id;
		$hist->title = 'Renewal Commission'; 
		$hist->amount = "$amount";
		$hist->created = date('Y-m-d H:i:s'); 
		$hist->reference = 'RC'.date('YmdHis').$user_id;
		$hist->type = 6; // 1 RENEW, 2 BUY IMALL, 3 TRANSFER TO OTHER USER, 4 DONATE, 5 WITHDRAW, 6 COMMISSION, 7 ADD FUND, 8 DEDUCT SMS 0.20, 9 SELL ON IMALL, 10 RECEIVE FROM OTHER USER, 11 BUY COMPANY ITEMS, 12 BUY E PINS,
		return $hist->save();
	}

	/**
	* If sms_setting = 1, send sms every get commission
	*/
	private function send_sms($phone) {
		
	}
	
}

