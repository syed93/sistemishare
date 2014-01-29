<?php

namespace JunMy\Frontend\Controllers;

use JunMy\Models\Users;
use JunMy\Models\Epins;
use JunMy\Components\Pagination\Pagination;

class EpinsController extends ControllerBase {
	
	
	public $salt_length = 9;
	
	public $paginationUrl;
	
	public function initialize() {
		$this->tag->setTitle('User register/login');
		parent::initialize();
	}
	
    public function indexAction() {
		parent::pageProtect(); 
	/*	$offset = mt_rand(0, 1000);
		$key = 'index_epins'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {*/
		    $this->view->setVar('users', $this->get_user($_SESSION['junauth']['id']));
		    $this->view->setVar('epins', $this->view_epin());
			$this->view->paginationUrl = $this->paginationUrl;
		/*}
		
		$this->view->cache(array("key" => $key));*/
	}
    
    public function addAction() {
        parent::pageProtect();
        $this->view->setVar('users', $this->get_user($_SESSION['junauth']['id']));
		if($this->request->isPost()) {
			if(is_numeric($this->request->getPost('count'))) {
				if($this->request->getPost('count') > 1) {
					// Generate E-Pin using Concate
					$date = date('Y-m-d H:i:s');
					
				    
				    $i = 0;
					for($i > 0; $i < $this->request->getPost('count'); $i++) {
						$epin = new Epins();
						$gen_plus = $this->generate();
	                    $epin->user_id = $_SESSION['junauth']['id'];
						$epin->epin = $gen_plus; 
						$epin->created = date('Y-m-d H:i:s'); 
						$epin->status = 0;
						$epin->used_username = 0;
						$epin->used_user_id = 0;
						$epin->last_owner = $_SESSION['junauth']['name'];
						$epin->token = 0;
						$epin->save(); 
					}
					$this->flash->success('iPin has been saved');
					//return $this->modelsManager->executeQuery($phql);	
				} elseif($this->request->getPost('count') == 1) {
					// Generate E-Pin without comma (,)
					
					$epin = new Epins();
					$gen_plus = $this->generate();
                    $epin->user_id = $_SESSION['junauth']['id'];
					$epin->epin = $gen_plus; 
					$epin->created = date('Y-m-d H:i:s'); 
					$epin->status = 0;
					$epin->used_username = 0;
					$epin->used_user_id = 0;
					$epin->last_owner = $_SESSION['junauth']['name'];
					$epin->token = 0;
					if($epin->save()) {
						$this->flash->success('iPin has been saved');
					} else {
			            foreach ($epin->getMessages() as $message) {
			                $this->flash->error((string) $message);
			            }
			        }
					
					 
				} else {
					$this->flash->error('Not valid number');
				} 
			} else {
				$this->flash->error('Please enter count epin');
			}
		} 
	}
	
	public function transferAction() {
		parent::pageProtect();
		// show form
		$this->view->hide = 0; 
	    $this->view->setVar('users', $this->get_user($_SESSION['junauth']['id']));
	     
	    $this->view->urlajax = $this->url->get('ajax/ajaxusername');
	    
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
			} elseif($count > count($this->select_epin($_SESSION['junauth']['id']))) {
				$this->flash->error('Baki iPin anda tidak mencukupi');
			} elseif(count($this->select_user($username)) != 1) {
				$this->flash->error('Username tidak terdapat di dalam sistem kami');
			} elseif(count($this->master_key($_SESSION['junauth']['id'], $master_key)) == 0) {
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
					$sender_id = $_SESSION['junauth']['id'];
					$sender_username = $_SESSION['junauth']['name'];
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
	
	public function viewuseripinAction() {
		parent::pageProtect();
		if($this->request->isGet('username')) {
		    
		    $user_id = $this->usernametoid($this->request->getQuery('username'));
		    $this->view->setVar('epins', $this->view_epin("WHERE e.user_id = '$user_id'"));
			
			
			
		}
		$this->view->paginationUrl = $this->paginationUrl;
	    $this->view->urlajax = $this->url->get('ajax/ajaxusername');
	    $this->view->setVar('users', $this->get_user($_SESSION['junauth']['id'])); 
	}
	
	/*
	*  Select count valid username
	*/
    private function select_user($username) {
		$phql = "SELECT * FROM JunMy\Models\Users WHERE username = '$username' LIMIT 1";
		$rows = $this->modelsManager->executeQuery($phql);
		return $rows;
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
	*  Select id from username, used on viewuseripin
	*/
	private function usernametoid($username) {
		$phql = "SELECT id FROM JunMy\Models\Users WHERE username = '$username' LIMIT 1";
		$rows = $this->modelsManager->executeQuery($phql);
		foreach($rows as $row) {
			return $row['id'];
		}
		
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
	
	private function get_user($id) {
	    $phql = "SELECT * FROM JunMy\Models\Users WHERE id = '$id' LIMIT 1";
		$rows = $this->modelsManager->executeQuery($phql);
		//$this->view->since = date('j F, Y', strtotime($rows['users']['created']));
		foreach($rows as $key => $row) {
			$this->due = $key['created'];
		}
		return $rows;
	}


    private function view_epin($where = NULL) {
		
	    $records_per_page = 25;
	    $paginations = new Pagination();
        $paginate = (($paginations->get_page() - 1) * $records_per_page);
		$phql = "SELECT
		    e.id AS id, e.user_id AS user_id, e.epin AS epin, e.created AS created, 
			e.status AS status, e.used_user_id AS used_user_id, e.last_owner AS last_owner,
		    u.username AS username, used.username AS used_username
			FROM JunMy\Models\Epins as e
			INNER JOIN JunMy\Models\Users AS u ON(e.user_id = u.id)
			LEFT JOIN JunMy\Models\Users AS used ON (e.used_user_id = used.id)
			 ".($where == '' ? '' : $where)." ORDER BY e.id ASC";
		 
		$count = $this->modelsManager->executeQuery($phql);	
        $paginations->records(count($count));
        $rows = $this->modelsManager->executeQuery($phql." LIMIT $paginate , $records_per_page");	
        // records per page
        $paginations->records_per_page($records_per_page);
		$this->paginationUrl = $paginations->render();

		return $rows;
	
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