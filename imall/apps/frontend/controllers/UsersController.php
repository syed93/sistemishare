<?php

namespace JunMy\Frontend\Controllers;

use JunMy\Models\Users;

class UsersController extends ControllerBase {
	
	public function initialize() {
		$this->tag->setTitle('User register/login');
		parent::initialize();
	}
	
	public function indexAction() {
	    if(!$this->session->get('junauth')) {
	        $this->flash->error('Please login to access members area');
			return $this->response->redirect('users/login');
		} else {
			print_r($_SESSION);
			echo session_id()."<br/>";
			session_regenerate_id();
			echo session_id();
		}
	}

    public function loginAction() {
		if ($this->request->isPost()) {
            $email = $this->request->getPost('email', 'email');

            $password = $this->request->getPost('password');
            $password = sha1($password);

            $user = Users::findFirst("email='$email' AND password='$password' AND active='Y'");
            if ($user != false) {
                $this->_registerSession($user);
                $this->flash->success('Welcome ' . $user->name);
                return $this->response->redirect('users/index');
            }

            $username = $this->request->getPost('email', 'alphanum');
            $user = Users::findFirst("username='$email' AND password='$password' AND active='Y'");
            if ($user != false) {
                $this->_registerSession($user);
                $this->flash->success('Welcome ' . $user->name);
                return $this->response->redirect('users/index');
            }

            $this->flash->error('Wrong email/password');
        }
        
        //return $this->response->redirect('users/login');
	}
	

    
    public function registerAction() {
        if($this->request->isPost()) { 
		    if(strlen($this->request->getPost('full_name')) < 5) {
				$this->flash->error('Please fill valid Full Name');
				
			} elseif(!is_numeric($this->request->getPost('nric')) || strlen($this->request->getPost('nric')) < 12) {
				$this->flash->error('Please fill valid I/C Number');
				
			} elseif(!is_numeric($this->request->getPost('phone'))) {
				$this->flash->error('Please fill valid phone number (0-9 only)');
				
			} elseif(strlen($this->request->getPost('phone')) < 9 || strlen($this->request->getPost('phone')) > 13) {
				$this->flash->error('Phone number between 9 to 13 character long');
				
			} elseif(!filter_var($this->request->getPost('email'), FILTER_VALIDATE_EMAIL)) {
				$this->flash->error('Please fill valid email address');
				
			} elseif(strlen($this->request->getPost('password')) < 6 || strlen($this->request->getPost('password')) > 18) {
				$this->flash->error('Password between 6 to 18 character long');
				
			}  elseif($this->request->getPost('retypePassword') != $this->request->getPost('password')) {
				$this->flash->error('Password not match');
				
			} elseif(strlen($this->request->getPost('address')) < 6 || strlen($this->request->getPost('address')) > 50) {
				$this->flash->error('Please fill address');
				
			} elseif(!is_numeric($this->request->getPost('postcode'))) {
				$this->flash->error('Please valid postcode, number only');
				
			} elseif(strlen($this->request->getPost('postcode')) < 4 || strlen($this->request->getPost('postcode')) > 7) {
				$this->flash->error('Postcode between 4 to 7 character long');
				
			} elseif($this->request->getPost('region_id') == 0) {
				$this->flash->error('Please select region');
				
			} else { 
				$users = new Users();
				
				$users->id = $this->request->getPost('id', 'int'); 
				$users->title = $this->request->getPost('title');  
				$users->description = $this->request->getPost('description');  
				$users->price = $this->request->getPost('price');  
				$users->category_id = $this->request->getPost('category_id', 'int');  
				$users->region_id = $this->request->getPost('region_id', 'int');  
				$users->user_id = 1; 
				$users->created = date('Y-m-d H:i:s'); 
				$users->url = $this->slug($this->request->getPost('title'));  
				$users->status = 1; 
				if (!$users->save()) {
		            foreach ($users->getMessages() as $message) {
		                $this->flash->error((string) $message);
		            }
		        } else {
		            $this->flash->success("Product was successfully updated");
		            return $this->response->redirect('users/steptwo');
		        }
		    }		
		}
        
		$offset = mt_rand(0, 958695);
		$key = 'userregister'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    $phql = 'SELECT
			id,
			name
			FROM JunMy\Models\Regions
			LIMIT 15';
			$bottoms = $this->modelsManager->executeQuery($phql);
	
			$this->view->setVar('bottoms', $bottoms);
	
			$phql = 'SELECT 
			id, name
			FROM JunMy\Models\Categories 
			LIMIT 20';
			$cats = $this->modelsManager->executeQuery($phql);
	
			$this->view->setVar('cats', $cats);
		}
		$this->view->cache(array("key" => $key));
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