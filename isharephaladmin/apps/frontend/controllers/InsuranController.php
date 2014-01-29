<?php

namespace JunMy\Frontend\Controllers;

use JunMy\Components\Pagination\Pagination;
use JunMy\Models\Notifications;
use JunMy\Models\Transactions;
use JunMy\Models\Users;
	
class InsuranController extends ControllerBase {
 
    public $paginationUrl;
    
    public $amount_to_pay;
    
    public $pagination_updated;
    
    public function initialize()
    {
        //Set the document title
        $this->tag->setTitle('iTakaful');
        parent::initialize();
    }

	public function manageAction() {
		parent::pageProtect();
		$this->view->setVar('views', $this->view_user());
		$this->view->paginationUrl = $this->paginationUrl;
	}
	
	/*
    *    View user on pagination where quotation done
    *
    */
	public function quotationAction() {
		parent::pageProtect();
		
	    $this->view->setVar('views', $this->view_user_updated());
	    $this->view->setVar('paginate', $this->pagination()); 
	
	}
	
	/*
    *    View all user
    *
    */
	public function allAction() {
		parent::pageProtect();
		$offset = mt_rand(0, 1000);
		$key = 'insurance_all'.$offset;
		$exists = $this->view->getCache()->exists($key);
		
		if (!$exists) { 
		    $this->view->setVar('views', $this->view_all_user());
		    $this->view->setVar('paginate', $this->pagination()); 
		} 
		$this->view->cache(array("key" => $key));
	}
	
	/*
    *    View user on pagination where type = 1
    *
    */
	public function kivAction() {
		parent::pageProtect();
		$offset = mt_rand(0, 1000);
		$key = 'insurance_kiv'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    
		    $this->view->setVar('views', $this->view_user_kiv());
		    
			$this->view->paginationUrl = $this->paginationUrl;
		}
		
		$this->view->cache(array("key" => $key));
		
		// Restore user from kiv lists
		if(isset($_GET['user_id']) && isset($_GET['ref'])) {
		    $user_id = $_GET['user_id'];
		    $ref = $_GET['ref'];
			if(is_numeric($user_id)) {
				// Proceed restore
				if($this->restore($user_id)) {
					$this->flash->success('User has been restore to iManagement');
				} 
			} else {
				$this->flash->error('Error! Not valid User Id');
			}
		}
	}
	
	/*
    *    Restore user from kiv
    *    Return BOOLEAN
    */
	private function restore($user_id) { 
	    $phql = "UPDATE JunMy\Models\Insuran SET 
		type = '0' WHERE user_id = '$user_id'";
		$update = $this->modelsManager->executeQuery($phql);
		if($update) {
		    return true;
		}
	
	}
	
	/*
    *    Add user to kiv
    *
    */
	public function addtokivAction() {
	    parent::pageProtect();
		$user_id = $this->dispatcher->getParam('slug');    
	    $phql = "UPDATE JunMy\Models\Insuran SET 
		type = '1' WHERE user_id = '$user_id'";
		$update = $this->modelsManager->executeQuery($phql);
		if($update) {
		    return $this->response->redirect('insuran/quotation');
		}
	
	}
	
	/*
    *    View user on pagination where done renew with ishare
    *
    */
	public function doneAction() {
		parent::pageProtect();
		$offset = mt_rand(0, 1000);
		$key = 'insurance_done'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    
		    $this->view->setVar('views', $this->view_user_done());
		    
			$this->view->paginationUrl = $this->paginationUrl;
		}
		
		$this->view->cache(array("key" => $key));
	}
	
	/*
    *    View user on pagination order by due date
    *    Used on manageAction
    */
    private function view_user() {
	 
		$time = strtotime(date('Y-m-d'));
        $created = date("Y-m-d", strtotime("+1 month", $time));
        	
	    $records_per_page = 30;
	    $paginations = new Pagination();
        $paginate = (($paginations->get_page() - 1) * $records_per_page);
		$phql = "SELECT
		    u.id AS id, 
			u.username AS username, 
			u.telephone AS tel, 
			u.reg_number AS reg_no, 
			u.owner_name AS owner,  
			u.model AS model, 
			u.year_make AS year,
			
			w.amount AS amount,
		    
		    i.insurance AS ins_amount, 
			i.road_tax AS r_amount, 
			i.total AS total, 
			i.next_renewal AS due
		    
			FROM JunMy\Models\Users AS u
			INNER JOIN JunMy\Models\Wallets AS w ON(w.id = u.id)
			LEFT JOIN JunMy\Models\Insuran AS i ON(i.user_id = u.id)
			WHERE u.verified = '1' AND i.next_renewal < '$created'".$this->search_parameter().$this->search_date()."
			ORDER BY i.next_renewal ASC";
			echo $phql;
		$count = $this->modelsManager->executeQuery($phql);	
        $paginations->records(count($count));
        $rows = $this->modelsManager->executeQuery($phql." LIMIT $paginate , $records_per_page");	
        // records per page
        $paginations->records_per_page($records_per_page);
		$this->paginationUrl = $paginations->render();

		return $rows;
	
	}
 	
	/*
    *    View user on pagination order by due date
    *
    */
    private function view_all_user() {
	 
	    $records_per_page = 30;
	    $paginations = new Pagination();
        $paginate = (($paginations->get_page() - 1) * $records_per_page);
		$phql = "SELECT
		    u.id AS id, 
			u.username AS username, 
			u.telephone AS tel, 
			u.reg_number AS reg_no, 
			u.owner_name AS owner,  
			u.model AS model, 
			u.year_make AS year,
			
			w.amount AS amount,
		    
		    i.insurance AS ins_amount, 
			i.road_tax AS r_amount, 
			i.total AS total, 
			i.next_renewal AS due
			FROM JunMy\Models\Users AS u
			INNER JOIN JunMy\Models\Wallets AS w ON(w.id = u.id)
			LEFT JOIN JunMy\Models\Insuran AS i ON(i.user_id = u.id)
			WHERE i.created < '$created' AND type = '0'
			ORDER BY i.next_renewal ASC";
		$count = $this->modelsManager->executeQuery($phql);	
        $paginations->records(count($count));
        $rows = $this->modelsManager->executeQuery($phql." LIMIT $paginate , $records_per_page");	
        // records per page
        $paginations->records_per_page($records_per_page);
		$this->paginationUrl = $paginations->render();

		return $rows;
	
	}
	
	/*
    *  View user on pagination order by due date
    *
    */
    private function view_user_kiv() {
		
	    $records_per_page = 30;
	    $paginations = new Pagination();
        $paginate = (($paginations->get_page() - 1) * $records_per_page);
		$phql = "SELECT
		    u.id AS id, 
			u.username AS username, 
			u.telephone AS tel, 
			u.reg_number AS reg_no, 
			u.owner_name AS owner,  
			u.model AS model, 
			u.year_make AS year,
			
			w.amount AS amount,
		    
		    i.insurance AS ins_amount, 
			i.road_tax AS r_amount, 
			i.total AS total, 
			i.next_renewal AS due
			FROM JunMy\Models\Users AS u
			INNER JOIN JunMy\Models\Wallets AS w ON(w.id = u.id)
			LEFT JOIN JunMy\Models\Insuran AS i ON(i.user_id = u.id)
			WHERE i.type = '1'".$this->search_parameter().$this->search_date()." 
			ORDER BY i.next_renewal ASC";
		$count = $this->modelsManager->executeQuery($phql);	
        $paginations->records(count($count));
        $rows = $this->modelsManager->executeQuery($phql." LIMIT $paginate , $records_per_page");	
        // records per page
        $paginations->records_per_page($records_per_page);
		$this->paginationUrl = $paginations->render();

		return $rows;
	
	}

	/*
    *    Select user where done updating
    *    Used private on quotationAction
    *    Return OBJECT
    */
    private function view_user_updated() {
     
		$time = strtotime(date('Y-m-d'));
        $created = date("Y-m-d", strtotime("-2 month", $time));
        
	    $records_per_page = 30;
	    $paginations = new Pagination();
        $paginate = (($paginations->get_page() - 1) * $records_per_page);
		$phql = "SELECT
		    u.id AS id, 
			u.username AS username, 
			u.telephone AS tel, 
			u.reg_number AS reg_no, 
			u.owner_name AS owner,  
			u.model AS model, 
			u.year_make AS year,
			
			w.amount AS amount,
		    
		    i.insurance AS ins_amount, 
			i.road_tax AS r_amount, 
			i.total AS total, 
			i.next_renewal AS due
			FROM JunMy\Models\Users AS u
			INNER JOIN JunMy\Models\Wallets AS w ON(w.id = u.id)
			LEFT JOIN JunMy\Models\Insuran AS i ON(i.user_id = u.id)
			WHERE i.created > '$created' AND type = '0'".$this->search_parameter().$this->search_date()." ORDER BY i.next_renewal ASC";
		$count = $this->modelsManager->executeQuery($phql);	
        $paginations->records(count($count));
        $rows = $this->modelsManager->executeQuery($phql." LIMIT $paginate , $records_per_page");	
        // records per page
        $paginations->records_per_page($records_per_page);
		$this->pagination_updated = $paginations->render();

		return $rows;
	
	}
	
	private function pagination() {
		return $this->pagination_updated;
	}

	/*
    *    Select user where done updating
    *    Used private on quotationAction
    *    Return OBJECT
    */
    private function view_user_done() {
     
		$time = strtotime(date('Y-m-d'));
        $created = date("Y-m-d", strtotime("+1 month", $time));
        
	    $records_per_page = 30;
	    $paginations = new Pagination();
        $paginate = (($paginations->get_page() - 1) * $records_per_page);
		$phql = "SELECT
		    u.id AS id, 
			u.username AS username, 
			u.telephone AS tel, 
			u.reg_number AS reg_no, 
			u.owner_name AS owner,  
			u.model AS model, 
			u.year_make AS year,
			
			w.amount AS amount,
		    
		    i.insurance AS ins_amount, 
			i.road_tax AS r_amount, 
			i.total AS total, 
			i.next_renewal AS due
			FROM JunMy\Models\Users AS u
			INNER JOIN JunMy\Models\Wallets AS w ON(w.id = u.id)
			LEFT JOIN JunMy\Models\Insuran AS i ON(i.user_id = u.id)
			WHERE i.next_renewal > '$created' AND type = '0'".$this->search_parameter().$this->search_date()." ORDER BY i.next_renewal ASC";
		$count = $this->modelsManager->executeQuery($phql);	
        $paginations->records(count($count));
        $rows = $this->modelsManager->executeQuery($phql." LIMIT $paginate , $records_per_page");	
        // records per page
        $paginations->records_per_page($records_per_page);
		$this->paginationUrl = $paginations->render();

		return $rows;
	
	}

	public function updateAction() {
		parent::pageProtect();
		//Jika post update
		if($this->request->isPost()) {
			if ($this->request->getPost('insuran_amount') == '0.00') {
				$this->flash->error('Please enter Insurance Amount');
			} elseif ($this->request->getPost('cover') == '0.00') { 
				$this->flash->error('Please enter Cover Amount');
			} else {
			    $created = date('Y-m-d H:i:s');
			    $total = $this->request->getPost('service_charge') + $this->request->getPost('insuran_amount') + $this->request->getPost('road_tax');
			    $insuran_amount = $this->request->getPost('insuran_amount');
				$road_tax = $this->request->getPost('road_tax');
			    $cover = $this->request->getPost('cover');
			    $service_charge = $this->request->getPost('service_charge');
			    $user_id = $this->request->getPost('user_id');
			    $due_date = $this->request->getPost('due_date');
			    $wind_screen = $this->request->getPost('wind_screen');
			    $second_driver = $this->request->getPost('second_driver');
			    
			    // Update insurance amount
				$phql = "UPDATE JunMy\Models\Insuran SET 
				insurance = '$insuran_amount', road_tax = '$road_tax', 
				cover = '$cover', service_charge = '$service_charge', wind_screen = '$wind_screen',
				second_driver = '$second_driver',
				total = '$total', created = '$created' WHERE user_id = '$user_id'";
				$update = $this->modelsManager->executeQuery($phql);
				if($update) {
				    if($this->update_notification($user_id, $due_date, $insuran_amount, $road_tax, $cover, $total)) {
						// Send SMS
						$this->flash->success('Insurance amount has been updated');
					}
				}
			}
		}
	
		$offset = mt_rand(0, 1000);
		$key = 'insuran_update'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    $this->view->setVar('updates', $this->view_user_update($this->dispatcher->getParam('slug')));
		    $this->view->setVar('profiles', $this->get_user_profile($this->dispatcher->getParam('slug')));
		    $this->view->back = $_SERVER['HTTP_REFERER'];
		}
		
		$this->view->cache(array("key" => $key));
	}
	
	private function get_user_profile($username) {
	    $phql = "SELECT * FROM JunMy\Models\Users WHERE username = '$username' LIMIT 1";
		$rows = $this->modelsManager->executeQuery($phql);
		//$this->view->since = date('j F, Y', strtotime($rows['users']['created']));
		foreach($rows as $key => $row) {
			$this->due = $key['created'];
		}
		return $rows;
	}
	
	public function renewAction() {
		if(!$this->session->get('junauth')) {
	        $this->flash->error('Please login to access members area');
			return $this->response->redirect('users/login');
		}
		
		if($this->request->isPost()) {
			//print_r($_POST);
			
			
			if($this->request->getPost('insuran_amount') == 0.00) {
				$this->flash->error('Sila masukan nilai insuran');
			} elseif($this->request->getPost('cover') == 0.00) {
				$this->flash->error('Sila masukan jumlah perlindungan');
			} else {
			    $total = $this->request->getPost('total');
			    $insuran_amount = $this->request->getPost('insuran_amount');
				$road_tax = $this->request->getPost('road_tax');
			    $cover = $this->request->getPost('cover');
			    $service_charge = $this->request->getPost('service_charge');
			    $user_id = $this->request->getPost('user_id');
				$add_wallet = $this->request->getPost('add_iwallet');
				 // If not empty add_iwallet
				if(!empty($add_wallet)) { 
					// Check amount is number format
					if(is_numeric($add_wallet)) {
						// Add iWallet & transaction history
						$this->add_wallet($user_id, $add_wallet);
						$this->transaction_history('AC', 'Admin Credit', $user_id, $add_wallet, 7, $_SESSION['junauth']['id']);
					}
					
				}   
			    
			    
				//Check baki ewallet > = total
				if($this->check_wallet($user_id) >= $total) {
				    // Tolak baki ewallet
				    if($this->deduct_wallet($user_id, $total)) {
				        // Update tarikh next renewal + 1 tahun
					    $next_renewal = date('Y-m-d', strtotime('+1 years'));
						$phql = "UPDATE JunMy\Models\Insuran SET 
						next_renewal = '$next_renewal' WHERE user_id = '$user_id'";
						$update = $this->modelsManager->executeQuery($phql);
						if($update) {
						    // Simpan transaksi history
						    if($this->transaction_history('IR', 'Insurance Renewal', $user_id, '-'.$total, 1)) {
								//Send Notification 
						        if($this->renew_notification($user_id, $next_renewal, $insuran_amount, $road_tax, $cover, $service_charge, $total)) {
									// HEADER LOCATION payout/user_id FOR PAYOUT AND SMS
									$this->response->redirect('commissions/payout?user_id='.$user_id.'&ins_amount='.$insuran_amount);
								}
							}  
						}
					} else {
						$this->flash->error('Fail to deduct wallet');
					}
				} else {
				    // Error jika ewallet kurang dari total
					$this->flash->error('This user not enough iWallet balance to renew');
				}	
			}
		}
		
		$offset = mt_rand(0, 1000);
		$key = 'insuran_renew'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    $this->view->setVar('updates', $this->view_user_update($this->dispatcher->getParam('slug')));
		    $this->view->setVar('profiles', $this->get_user_profile($this->dispatcher->getParam('slug')));
		    $this->view->back = $_SERVER['HTTP_REFERER'];
		    $this->view->amount_to_pay = $this->amount_to_pay;
		}
		
		$this->view->cache(array("key" => $key));
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
		$hist->pic = $pic;
		// 1 RENEW, 2 BUY IMALL, 3 TRANSFER TO OTHER USER, 4 DONATE, 5 WITHDRAW, 6 COMMISSION, 7 ADD FUND, 8 DEDUCT SMS 0.20, 9 SELL ON IMALL, 10 RECEIVE FROM OTHER USER, 11 BUY COMPANY ITEMS, 12 BUY E PINS,
		return $hist->save();
	}
	
	/*
	*  Check ewallet balance, Used on renewAction. 
	*  Return BOOLEAN
	*/
	private function check_wallet($id) {
		$phql = "SELECT amount FROM JunMy\Models\Wallets 
		         WHERE user_id = '$id'";
		$rows = $this->modelsManager->executeQuery($phql);
		foreach($rows as $row) {
			return $row['amount'];
		}
	}
	
	/*
	*  Add iWallet, used on renewAction
	*/
	private function add_wallet($id, $amount) {
		$phql = "UPDATE JunMy\Models\Wallets SET 
				amount = amount + '$amount' WHERE user_id = '$id'";
		$update = $this->modelsManager->executeQuery($phql);
		if($update) {
			return true;
		}
	}
	
	/*
	*  Deduct after success renewal, used on renewAction
	*/
	private function deduct_wallet($id, $amount) {
		$phql = "UPDATE JunMy\Models\Wallets SET 
				amount = amount - '$amount' WHERE user_id = '$id'";
		$update = $this->modelsManager->executeQuery($phql);
		return $update;
	}
    
    /*
	*  Send notification after success renew, used on renewAction
	*/
    private function renew_notification($user_id, $next_renewal, $insuran_amount, $road_tax, $cover, $service_charge, $total) {
		$note = new Notifications();
	    $note->user_id = $user_id;
	    $note->body = "Your insurance has been renew, Next renewal on: $next_renewal. Insurance amount: RM$insuran_amount. Road tax: RM$road_tax. Cover RM$cover. Service charge RM$service_charge. Total: $total";
	    $note->created = date('Y-m-d H:i:s');
	    $note->read = 0;
	    $note->type = 2;
	    return $note->save();
	}
	
	/*
	*  Send notification after UPDATEw, used on updateAction
	*/
	private function update_notification($user_id, $due_date, $insuran_amount, $road_tax, $cover, $total) {
		//Send SMS	& notification
	    $note = new Notifications();
	    $note->user_id = $user_id;
	    $note->body = "Your insurance has been update, Due date: $due_date. Insurance amount: RM$insuran_amount. Road tax: RM$road_tax. Cover RM$cover. Total: $total";
	    $note->created = date('Y-m-d H:i:s');
	    $note->read = 0;
	    $note->type = 1;
	    return $note->save();
	}
	
	private function view_user_update($id) {
	    $id = filter_var($id, FILTER_SANITIZE_ENCODED);
		$phql = "SELECT
		    u.id AS id, u.username AS username, u.name AS name, u.telephone AS tel, u.road_tax AS r_tax, u.insuran_due_date AS due, 
			u.reg_number AS reg_no, u.owner_name AS owner, u.owner_nric AS owner_ic, u.owner_dob AS owner_dob, u.model AS model, 
			u.year_make AS year, u.capacity AS cc, u.engine_number AS eng_no, u.chasis_number AS chasis, u.grant_serial_number AS grant, 
			
			w.id AS w_id, w.user_id AS u_id, w.amount AS amount,
		    
		    i.second_driver AS second_driver, i.wind_screen AS wind_screen, i.insurance AS ins_amount, i.road_tax AS r_amount, i.cover AS cover, i.service_charge AS charge, i.total AS total, i.next_renewal AS due_date
		    
			FROM JunMy\Models\Users AS u
			INNER JOIN JunMy\Models\Wallets AS w ON(w.id = u.id)
			LEFT JOIN JunMy\Models\Insuran AS i ON(i.user_id = u.id)
			WHERE u.username LIKE '$id' LIMIT 1";
			$rows = $this->modelsManager->executeQuery($phql);	
			foreach($rows as $row) {
			    // IF wallet balance > = total to pay that mean amount to pay = 0
			    if($row['amount'] >= $row['total']) {
					$amount_to_pay = 0.00;
				} else {
					$amount_to_pay = $row['total'] - $row['amount'];
				}
				$this->amount_to_pay = $amount_to_pay;
			}
        return $rows;
	}
	
	/*
    *  Add parameters on search
    *
    */
    private function search_parameter() {
		if(isset($_GET['submit'])) {
			$query = filter_input(INPUT_GET, 'query', FILTER_SANITIZE_ENCODED);
			return " AND u.username LIKE '%$query%' OR u.reg_number LIKE '%$query%' OR u.telephone LIKE '%$query%'";
		}
	}
	
	/*
    *  Add parameters on search
    *
    */
    private function search_date() {
		if(isset($_GET['from']) && isset($_GET['to'])) {
		    $from = $_GET['from'];
		    $to = $_GET['to'];
		    
			return " AND i.next_renewal BETWEEN '$from' AND '$to'";
		}
	}


}

