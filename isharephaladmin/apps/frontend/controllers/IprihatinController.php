<?php

namespace JunMy\Frontend\Controllers;

use JunMy\Models\Users; 
use JunMy\Components\Pagination\Pagination;
use JunMy\Components\Imageupload\Imageupload;
use JunMy\Components\Thumbnail\Thumbnail;
use JunMy\Models\Iprihatin; 
use JunMy\Models\Iprihatinphoto;

class IprihatinController extends ControllerBase {
	
	public $paginationUrl;
	
	public function initialize() {
		$this->tag->setTitle('iPrihatin');
		parent::initialize();
	}
	
	public function indexAction() {
		parent::pageProtect(); 
		$offset = mt_rand(0, 1000);
		$key = 'iprihatin_index_'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    $this->view->setVar('users', $this->get_user($_SESSION['junauth']['id'])); 
			$this->view->setVar('iprihatins', $this->view_all_post());
		    
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
		    $this->view->setVar('users', $this->get_user($_SESSION['junauth']['id'])); 
			$this->view->setVar('iprihatins', $this->view_post($this->dispatcher->getParam('slug'))); 
		}
		 
		$this->view->cache(array("key" => $key));
	}
	
	public function addAction() {
		parent::pageProtect();
		
		//print_r(getimagesize('uploads/iprihatins/imall765057rtyr967ry9re5dfulk767.jpg'));
		$offset = mt_rand(0, 251000);
		$key = 'iprihatin_new_post'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    $this->view->setVar('users', $this->get_user($_SESSION['junauth']['id'])); 
		}
		 
		$this->view->cache(array("key" => $key));
		
		if($this->request->isPost()) {
			if(strlen($this->request->getPost('title')) < 10) {
				$this->flash->error('Please enter iPrihatin title');
			} elseif(strlen($this->request->getPost('body')) < 10){
				$this->flash->error('Please enter iPrihatin body');
			} elseif($this->request->hasFiles() == false) {
				$this->flash->error('Please select atleast 1 image');
			} else {
			    
			    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    			$body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_SPECIAL_CHARS);
				$post = new Iprihatin();
				$post->title = $title;
				$post->body = $body;
				$post->created = date('Y-m-d H:i:s');
				$post->slug = $this->slug($title.'-'.date('Y-m-d-H-i-s'));
				$post->type = 1;
				$post->amount = 0.00;
				$post->pic = $_SESSION['junauth']['id'];
				if (!$post->save()) {
		            foreach ($post->getMessages() as $message) {
		                $this->flash->error((string) $message);
		            }
		
		        } else {
		            $this->save_image($post->id, 'image1');
		        }  
			}
		}
	}
	
	public function editAction() {
		parent::pageProtect();
		$offset = mt_rand(0, 251000);
		$key = 'iprihatin_edit_'.$this->dispatcher->getParam('slug').$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    $this->view->setVar('users', $this->get_user($_SESSION['junauth']['id'])); 
			$this->view->setVar('iprihatins', $this->view_post($this->dispatcher->getParam('slug')));
		     
		} 
		$this->view->cache(array("key" => $key));
		if($this->request->isPost()) {
		    $slug = $this->dispatcher->getParam('slug');
			$post = Iprihatin::findFirst("slug='$slug'");
			$post->body = $this->request->getPost('body');
			if($post->save()) {
				$this->flash->success('iPrihatin has been saved');
				return $this->response->redirect("iprihatin/view/".$slug);
			} else {
				$this->flash->error('Error IP9094, Please contact Azrul');
			}
		}
	}
	
	/*
	*  Insert new post
	*  Used on addAction
	*/
	private function save_image($id, $img_name) {
	    
	    $upload = new Imageupload();
		$upload->setpath('uploads/iprihatins/');
		if($upload->valid_image($img_name, 500, 500)) {
			if($upload->valid_size($img_name, 4024)) {
			    $newname = date('Ymdhis');
				if($upload->upload($img_name, $newname)) {
					
					$image = new Iprihatinphoto();
					$image->iprihatin_id = $id;
					$image->image_name = $upload->rename;
					if (!$image->save()) {
			            foreach ($image->getMessages() as $message) {
			                $this->flash->error((string) $message);
			            } 
			        } else {
			            $this->flash->success("iPrihatin has been saved");
			            
			        }
					
				} else {
					$this->flash->error('Error on upload');
				}
				
			} else {
				$this->flash->error('Maximum 1mb file size');
			}
		} else {
			$this->flash->error('Image too small, W500px x H500px');
		}
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
			i.title AS title, i.body AS body, i.created AS created, i.slug AS slug, 
			i.amount AS amount, i.type AS type, i.pic AS pic,
			p.image_name AS image
		FROM JunMy\Models\Iprihatin AS i
		LEFT JOIN JunMy\Models\Iprihatinphoto AS p on(p.iprihatin_id = i.id) 
		WHERE i.slug LIKE '$slug' LIMIT 1";
		$rows = $this->modelsManager->executeQuery($phql);
	 
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
	
	/*
	*  VReplace title to url
	*  Return STRING
	*/	
	private function slug($string) {
		return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', 
		html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', 
		htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
	}
}