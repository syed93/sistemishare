<?php

namespace JunMy\Frontend\Controllers;

use JunMy\Models\Posts;

class PostsController extends ControllerBase {
	
	public $postform;
	
	public function initialize()
    {
        //Set the document title
        $this->tag->setTitle('New ads');
        parent::initialize();
    }
	
	public function indexAction() {
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
				
			} elseif($this->request->getPost('category_id') == 0) {
				$this->flash->error('Please select category');
				
			} elseif(strlen($this->request->getPost('title')) < 6 || strlen($this->request->getPost('title')) > 55) {
				$this->flash->error('Please fill title between 6 to 55 character');
				
			} elseif(strlen($this->request->getPost('description')) < 6) {
				$this->flash->error('Please fill ad description minimum 6 character');
				
			} else { 
				$this->session->set('jun_post_data', $_POST);
				//return $this->response->redirect('posts/steptwo');
				//print_r($this->session->get('jun_post_data'));
				
				$posts = new Posts();
				
				$posts->id = $this->request->getPost('id', 'int'); 
				$posts->title = $this->request->getPost('title');  
				$posts->description = $this->request->getPost('description');  
				$posts->price = $this->request->getPost('price');  
				$posts->category_id = $this->request->getPost('category_id', 'int');  
				$posts->region_id = $this->request->getPost('region_id', 'int');  
				$posts->user_id = 1; 
				$posts->created = date('Y-m-d H:i:s'); 
				$posts->url = $this->slug($this->request->getPost('title'));  
				$posts->status = 1; 
			if (!$posts->save()) {
	            foreach ($posts->getMessages() as $message) {
	                $this->flash->error((string) $message);
	            }
	
	        } else {
	            $this->flash->success("Product was successfully updated");
	            return $this->response->redirect('posts/steptwo');
	        }
		}
			
			
		} 
		$offset = mt_rand(0, 958695);
		$key = 'postsnew'.$offset;
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
	
	public function steptwoAction() {
	    if ($this->session->has('jun_post_data')) {
			$this->view->setVar('posts', $this->session->get('jun_post_data'));
			$this->view->category = $this->getcategory($this->session->get('jun_post_data')['category_id']);
			$this->view->region = $this->getregion($this->session->get('jun_post_data')['region_id']);
			
        } else {
			return $this->response->redirect('posts/new');
		}
	}
	
	private function slug($string) {
		return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', 
		html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', 
		htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
	}
	
    private function getcategory($id) {
		$phql = "SELECT 
			name
			FROM JunMy\Models\Categories 
			WHERE id = $id
			LIMIT 1";
			$cats = $this->modelsManager->executeQuery($phql);
		foreach($cats as $cat) {
			return $cat['name'];
		}
	}
	
	private function getregion($id) {
		$phql = "SELECT 
			name
			FROM JunMy\Models\Regions 
			WHERE id = $id
			LIMIT 1";
			$regs = $this->modelsManager->executeQuery($phql);
		foreach($regs as $reg) {
			return $reg['name'];
		}
	}
    
    public function newAction() {
		
	}
}