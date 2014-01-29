<?php

namespace JunMy\Frontend\Controllers;

use JunMy\Models\Users;
use JunMy\Models\Wallets;
use JunMy\Components\Pagination\Pagination;

class UsersController extends ControllerBase {
	
	
	public $salt_length = 9;
	
	public $paginationUrl;
	
	public function initialize() {
		$this->tag->setTitle('User register/login');
		parent::initialize();
	}
	
	public function indexAction() {
	    parent::pageProtect();
		$offset = mt_rand(0, 561000);  
		$key = 'user_index_'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    
			$this->view->setVar('users', $this->get_user($_SESSION['junauth']['id']));
			
		}
		
		$this->view->cache(array("key" => $key)); 
	}
	
    public function loginAction() {
		if ($this->request->isPost()) {
            $username = $this->request->getPost('email', 'email');
            $password = $this->request->getPost('password');
            $user = Users::findFirst("username='$username'");
            if ($user != false) {
			    if($user->password === $this->passwordHash($password,substr($user->password, 0, 9))) {
					$this->_registerSession($user);
	                $this->flash->success('Welcome ' . $user->username);
	                return $this->response->redirect('users/index');
				}
            }
            $this->flash->error('Wrong email/password');
        }
        
        //return $this->response->redirect('users/login');
	}
	
    public function viewAction() {
		parent::pageProtect();
		$offset = mt_rand(0, 1000);
		$key = 'userview'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    $this->view->setVar('users', $this->get_user($_SESSION['junauth']['id']));
		    $this->view->setVar('views', $this->view_user());
			$this->view->paginationUrl = $this->paginationUrl;
		}
		
		$this->view->cache(array("key" => $key));
	}
	
	public function profileAction() {
		parent::pageProtect();
		$offset = mt_rand(0, 1000);
		$key = 'user_profile'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    $this->view->setVar('users', $this->get_user_profile($this->dispatcher->getParam('slug'))); 
		    $this->view->back = $_SERVER['HTTP_REFERER'];
		}
		
		$this->view->cache(array("key" => $key));
	}
	
	private function get_user_profile($username) {
	    $phql = "SELECT * FROM JunMy\Models\Users WHERE username = '$username'";
		$rows = $this->modelsManager->executeQuery($phql);
		//$this->view->since = date('j F, Y', strtotime($rows['users']['created']));
		foreach($rows as $key => $row) {
			$this->due = $key['created'];
		}
		return $rows;
	}
	
	// 	id	username_sponsor	username	name	password	nric_new	kin_name	relation	nric_new_kin	bank_number	bank_name	address	postcode	telephone	email	previous_insuran_company	cover_note	insuran_ncb	road_tax	insuran_due_date	reg_number	owner_name	owner_nric	owner_dob	model	year_make	capacity	engine_number	chasis_number	grant_serial_number	ip_address	created	payment	email_verification	verified	role	ckey	profile_image	sms_setting	master_key
	private function get_user($id) {
	    $phql = "SELECT u.username AS username, u.email AS email, u.insuran_due_date AS insuran_due_date, 
		u.profile_image AS profile_image, u.reg_number AS reg_number,
	      w.amount AS amount
		  FROM JunMy\Models\Users AS u
		  INNER JOIN JunMy\Models\Wallets AS w ON(u.id = w.user_id) 
		  WHERE u.id = '$id'";
		$rows = $this->modelsManager->executeQuery($phql);
		//$this->view->since = date('j F, Y', strtotime($rows['users']['created']));
		foreach($rows as $key => $row) {
			$this->due = $key['created'];
		}
		return $rows;
	}	
    
    private function view_user() {
		
	    $records_per_page = 30;
	    $paginations = new Pagination();
        $paginate = (($paginations->get_page() - 1) * $records_per_page);
		$phql = "SELECT
		    *
			FROM JunMy\Models\Users 
			
			ORDER BY id DESC";
		$count = $this->modelsManager->executeQuery($phql);	
        $paginations->records(count($count));
        $rows = $this->modelsManager->executeQuery($phql." LIMIT $paginate , $records_per_page");	
        // records per page
        $paginations->records_per_page($records_per_page);
		$this->paginationUrl = $paginations->render();

		return $rows;
	
	}
    
	public function passwordHash($pwd, $salt = null) {
        if ($salt === null)     {
            $salt = substr(md5(uniqid(rand(), true)), 0, $this->salt_length);
        } else {
            $salt = substr($salt, 0, $this->salt_length);
        }
        return $salt . sha1($pwd . $salt);
    }
    
    
	
	/**
     * Finishes the active session redirecting to the index
     *
     * @return unknown
     */
    public function logoutAction()
    {
        $this->session->remove('junauth');
        $this->flash->success('Goodbye!');
        return $this->response->redirect('users/login');
    }
}