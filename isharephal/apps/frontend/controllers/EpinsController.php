<?php

namespace JunMy\Frontend\Controllers;

use JunMy\Models\Users;
use JunMy\Models\Epins;
use JunMy\Components\Pagination\Pagination;

class EpinsController extends ControllerBase {
	
	
	public $salt_length = 9;
	
	public $paginationUrl;
	
	public function initialize() {
		$this->tag->setTitle('User ePins');
		parent::initialize();
	}
	
    public function indexAction() {
		parent::pageProtect();
		
		if($this->request->isPost()) {
			if(is_numeric($this->request->getPost('count'))) {
				if($this->request->count_user('username') == 1) {
				    $limit = $this->request->getPost('count');
					// Generate E-Pin using Concate
					$phql = "SELECT * FROM JunMy\Models\Epins WHERE user_id = '$id' LIMIT $limit";
					$rows = $this->modelsManager->executeQuery($phql);
					//$this->view->since = date('j F, Y', strtotime($rows['users']['created']));
				
					if(count($rows) < $limit) {
						$this->flash->error('iPin tidak mencukupi');
					} else {
						foreach($rows as $row) {
							
						}
					}
					
					$this->response->redirect('epins/index');
					//return $this->modelsManager->executeQuery($phql);	
				} else {
					$this->flash->error('Username tidak wujud');
				} 
				
			} else {
				$this->flash->error('Sila masukan jumlah iPin');
			}
		
		}
	/*	$offset = mt_rand(0, 1000);
		$key = 'index_epins'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {*/
		    $this->view->setVar('users', $this->get_user($_SESSION['jun_user_auth']['id']));
		    $this->view->setVar('epins', $this->view_epin($_SESSION['jun_user_auth']['id']));
			$this->view->paginationUrl = $this->paginationUrl;
		/*}
		
		$this->view->cache(array("key" => $key));*/
	}
	
	public function transferAction() {
		parent::pageProtect();
		// show form
		$this->view->hide = 0; 
	    $this->view->setVar('users', $this->get_user($_SESSION['jun_user_auth']['id']));
	     
	    $this->view->urlajax = $this->url->get('graph/username');
		if($this->request->isPost()) {
			$username = $this->request->getPost('username');
            $count = $this->request->getPost('count');
            $master_key = $this->request->getPost('master_key');
            // Check valid number
            if(!is_numeric($count)) { 
                // Check epin balance
				$this->flash->error('Jumlah ePin tidak sah, Sila masukan nombor sahaja'); 	 
			} elseif(strlen($username) < 5 && strlen($username) > 18) {
				$this->flash->error('Username penerima tidak sah');
			} elseif(!ctype_alnum($username)) {
				$this->flash->error('Username penerima tidak sah');
			} elseif($count > count($this->select_epin($_SESSION['jun_user_auth']['id']))) {
				$this->flash->error('Baki ePin anda tidak mencukupi');
			} elseif(count($this->select_user($username)) != 1) {
				$this->flash->error('Username tidak terdapat di dalam sistem kami');
			} elseif(count($this->master_key($_SESSION['jun_user_auth']['id'], $master_key)) == 0) {
				$this->flash->error('Kod transaksi tidak sepadan');
			} else {
			    
			    // Hide form
			    $this->view->hide = 1;
			    
			    $users = Users::findFirst("username='$username'");
				$this->flash->success('<h3>Adakah anda pasti?</h3>');
				     
				    echo '<form action="" method="get">';
				    echo '<input type="hidden" name="ntsv" value="'.$this->passwordHash($users->username).'">';
				    echo '<input type="hidden" name="ref" value="'.$this->passwordHash($users->username).date('YmdHis').'">';
				    echo '<input type="hidden" name="status" value="'.$users->id.'">';
				    echo '<input type="hidden" name="nt" value="'.$count.'">';
					echo '<label><p>Username Penerima:</p>'.$users->username.'</label>';
					echo '<label><p>Nama Penerima: </p>'.$users->name.'</label>';
					echo '<label><p>No Pendaftaran: </p>'.$users->reg_number.'</label>';
					echo '<label><p>No Telefon: </p>'.$users->telephone.'</label>';
				    echo '<label><p>&nbsp;</p><input type="submit" name="proceed" value="Batal" class="jun_button">&nbsp;
					<input type="submit" name="proceed" value="Teruskan" class="jun_button"></label>';
					echo '</form>';
			
			} 
			
			 
		} 
		
		
		// Confirmation transfer epin
		if(isset($_GET['ref']) && isset($_GET['ntsv']) && isset($_GET['status']) && isset($_GET['proceed']) && isset($_GET['nt'])) {
			if($_GET['proceed'] == 'Batal') {
				$this->response->redirect('epins/transfer');
			} elseif($_GET['proceed'] == 'Teruskan' && is_numeric($_GET['status']) && is_numeric($_GET['nt']) && ctype_alnum($_GET['ref'])) {
				
				// Prevent REFRESH PAGE
				$token = $_GET['ref'];
				if(count($this->select_epin_token($token)) > 0) {
					$this->flash->error('Token tidak sah, sila cuba sekali lagi');
				} else {
					// Proceed transfer
					$receiver_id = $_GET['status'];
					$total_epin = $_GET['nt'];
					$sender_id = $_SESSION['jun_user_auth']['id'];
					$sender_username = $_SESSION['jun_user_auth']['username'];
				    if($this->update_epin($receiver_id, $sender_id, $sender_username, $total_epin, $token)) {
						$this->flash->success('Pemindahan iPin telah berjaya');
					} else {
						$this->flash->error('Error pada iPin transfer');
				    } 	
				}
				
				
			} else {
				$this->flash->error('Pemindahan iPin tidak sah');
			} 
		} 
	}
	
	/*
	*  Prevent refresh transfer on get form
	*/
    private function select_epin_token($token) {
		$phql = "SELECT id FROM JunMy\Models\Epins WHERE token = '$token' LIMIT 1";
		$rows = $this->modelsManager->executeQuery($phql);
		
		return $rows;
	}
	
	/*
	*  Select and count epin balance from sender
	*/
	private function select_epin($user_id) {
		$phql = "SELECT id FROM JunMy\Models\Epins WHERE user_id = '$user_id'";
		$rows = $this->modelsManager->executeQuery($phql);
		
		return $rows;
	}
	
	/*
	*  Select and count master key from users table
	*/
	private function master_key($user_id, $master_key) {
		$phql = "SELECT master_key FROM JunMy\Models\Users WHERE id = '$user_id' AND master_key = '$master_key' LIMIT 1";
		$rows = $this->modelsManager->executeQuery($phql);
		
		return $rows;
	}
    
    /*
	*  Select count valid username
	*/
    private function select_user($username) {
		$phql = "SELECT * FROM JunMy\Models\Users WHERE username = '$username' LIMIT 1";
		$rows = $this->modelsManager->executeQuery($phql);
		return $rows;
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
	
	private function count_user($id) {
	    $phql = "SELECT username FROM JunMy\Models\Users WHERE username = '$id' LIMIT 1";
		$rows = $this->modelsManager->executeQuery($phql);
		//$this->view->since = date('j F, Y', strtotime($rows['users']['created']));
		
		return count($rows);
	}
	
	/*
	*  Update ePin user_id to receiver
	*/
	private function update_epin($to_user_id, $from_user_id, $from_username, $limit, $token) {
	    $date = date('Y-m-d H:i:s');
		$phql = "UPDATE JunMy\Models\Epins SET 
				user_id = '$to_user_id', 
				last_owner = CONCAT(last_owner, ', ', '$from_username'), 
				token = '$token', 
				created = '$date'
				WHERE user_id = '$from_user_id' 
				AND used_user_id = '0' LIMIT $limit";
		$update = $this->modelsManager->executeQuery($phql);
		return $update;
	}


    private function view_epin($id) {
		
	    $records_per_page = 25;
	    $paginations = new Pagination();
        $paginate = (($paginations->get_page() - 1) * $records_per_page);
		$phql = "SELECT
		    *
			FROM JunMy\Models\Epins 
			WHERE user_id = '$id' AND used_user_id = '0'
			ORDER BY id ASC";
		$count = $this->modelsManager->executeQuery($phql);	
        $paginations->records(count($count));
        $rows = $this->modelsManager->executeQuery($phql." LIMIT $paginate , $records_per_page");	
        // records per page
        $paginations->records_per_page($records_per_page);
		$this->paginationUrl = $paginations->render();

		return $rows;
	
	}
	
	private function generate($length = 12) {
		$password = "";
		$possible = "N1CD4GHEQRST5FK2Z3JAW4XB7Y8LMP6U9VAFGY52RJEU73856U87T3YD64ET49RH65U79Y5W9U656UH5T65W";  
		$i = 0; 
		while ($i < $length) { 
			$char = substr($possible, mt_rand(0, strlen($possible)-1), 1); 
			if (!strstr($password, $char)) { 
			  $password .= $char;
			  $i++;
			} 
		} 
		return $password; 
	}
	
	public function passwordHash($pwd, $salt = null) {
        if ($salt === null)     {
            $salt = substr(md5(uniqid(rand(), true)), 0, $this->salt_length);
        } else {
            $salt = substr($salt, 0, $this->salt_length);
        }
        return $salt . sha1($pwd . $salt);
    }

}