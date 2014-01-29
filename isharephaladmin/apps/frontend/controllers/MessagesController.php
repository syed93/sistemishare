<?php

namespace JunMy\Frontend\Controllers;

use JunMy\Models\Users; 
use JunMy\Models\Messages; 
use JunMy\Components\Pagination\Pagination;

class MessagesController extends ControllerBase {
	
	public $paginationUrl;
	
	public $body, $time, $date, $read_date, $read_time, $title = '';
	
	public function initialize() {
		$this->tag->setTitle('iMail');
		parent::initialize();
	}
	
	public function indexAction() {
		parent::pageProtect(); 
		$offset = mt_rand(0, 1000);
		$key = 'messages_index_'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    $this->view->setVar('users', $this->get_user($_SESSION['junauth']['id']));
		    $this->view->views = $this->view_messages('to_user_id', $_SESSION['junauth']['id'], 'm.from_user_id');
		    
			$this->view->paginationUrl = $this->paginationUrl;
		}
		$this->view->cache(array("key" => $key));
		$this->title = 'Dashboard';
	}
	
	public function viewAction() {
	    parent::pageProtect(); 
		$offset = mt_rand(0, 1000);
		$key = 'messages_view_'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    //$this->dispatcher->getParam('slug'); 
		    $this->view->setVar('views', $this->read_messages($this->dispatcher->getParam('id'), $_SESSION['junauth']['id']));
		    $this->view->setVar('users', $this->get_user($_SESSION['junauth']['id']));
		    $this->view->read_date = $this->read_date;
			$this->view->read_time = $this->read_time;
			$this->view->image_dir = $this->user_image_dir();
		}
	    $this->view->cache(array("key" => $key)); 
	}
	
	public function composeAction() {
		parent::pageProtect(); 
		$offset = mt_rand(0, 1000);
		$key = 'messages_compose_'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) { 
		    $this->view->setVar('users', $this->get_user($_SESSION['junauth']['id'])); 
			$this->view->image_dir = $this->user_image_dir();
			$this->view->urlajax = $this->url->get('graph/username');
			
		}
	    $this->view->cache(array("key" => $key)); 
	}
	
	/*
	*  Ajax preview from admin send message
	*/
	public function previewAction() {
		$this->view->disable();
		print_r($_POST);
	}
	
	private function read_messages($id, $user_id) {
		$phql = "SELECT
		    m.id AS m_id, m.from_user_id AS from_id, m.to_user_id AS to_id, m.body AS body, m.created AS created, m.time AS time, m.is_read AS is_read,
			u.username AS username, u.id AS user_id, u.profile_image AS image
			FROM JunMy\Models\Messages AS m 
			INNER JOIN JunMy\Models\Users AS u ON(m.from_user_id = u.id) 
			WHERE m.id='$id' LIMIT 1";
		$rows = $this->modelsManager->executeQuery($phql);
		foreach($rows as $row) {
			$this->read_date = date("j F", strtotime($row['created']));
			$this->read_time = date("g:i a", strtotime($row['time']));
		}
		return $rows;
	}
	
	public function sentitemsAction() {
		parent::pageProtect(); 
		$offset = mt_rand(0, 1000);
		$key = 'messages_sentitems_'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    $this->view->setVar('users', $this->get_user($_SESSION['junauth']['id']));
		    $this->view->views = $this->view_messages('from_user_id', $_SESSION['junauth']['id'], 'm.to_user_id');
		    
			$this->view->paginationUrl = $this->paginationUrl;
		}
		$this->view->cache(array("key" => $key));
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
	
	private function view_messages($column, $id, $join) {
		$records_per_page = 30;
	    $paginations = new Pagination();
        $paginate = (($paginations->get_page() - 1) * $records_per_page);
		$phql = "SELECT
		    m.id AS id, m.from_user_id AS from_id, m.to_user_id AS to_id, m.body AS body, m.created AS created, m.time AS time, m.is_read AS is_read,
			u.username AS username 
			FROM JunMy\Models\Messages AS m 
			INNER JOIN JunMy\Models\Users AS u ON(m.from_user_id = u.id) 
			WHERE $column='$id'
			ORDER BY m.id DESC";
		$count = $this->modelsManager->executeQuery($phql);	
        $paginations->records(count($count));
        $rows = $this->modelsManager->executeQuery($phql." LIMIT $paginate , $records_per_page");	
        // records per page
        $paginations->records_per_page($records_per_page);
		$this->paginationUrl = $paginations->render();
        foreach($rows as $row) { 
			echo "<tr><td><p>".$row['username']."</p></td>
			<td><p><a href='view/".$row['id']."'>".substr($row['body'], 0, 55)."</a></p></td>
			
			<td><p>".date("j F", strtotime($row['created']))."</p></td>
			<td><p>".date("g:i a", strtotime($row['time']))."</p></td></tr>";
		}
		//return $rows;
	}
}