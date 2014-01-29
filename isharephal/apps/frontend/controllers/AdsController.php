<?php

namespace JunMy\Frontend\Controllers;
	
class AdsController extends ControllerBase {
 
    public $post_id;
    
    public $title;
	
	public function initialize() {
		$this->tag->setTitle($this->title);
		parent::initialize();
	}   

	public function indexAction() { 
		$key = 'ads'.mt_rand(0, 99999987);
		if (!$this->view->getCache()->exists($key)) {		    
			$this->view->setVar('posts', $this->getselect());
			$this->view->setVar('images', $this->getimage());
		}
		$this->view->cache(array("key" => $key));
	}
	
	public function getselect() {
		$phql = "SELECT
		    p.id, p.title, p.description, 
		    c.name AS cat_name, c.id AS cat_id,
		    r.name AS reg_name, r.id AS reg_id,
		    i.name AS image_name, i.post_id AS image_id,
		    u.id AS user_id, u.username AS user_name, u.profile_image AS profile_img,
		    u.phone AS phone, u.email AS user_email, u.business_name AS biz_name, u.city AS city, u.created_at AS since
			FROM JunMy\Models\Tests p
			JOIN JunMy\Models\Categories c
			JOIN JunMy\Models\Regions r
			JOIN JunMy\Models\Users u ON(p.user_id = u.id)
			LEFT OUTER JOIN JunMy\Models\Images i ON(p.id = i.post_id) 
			WHERE p.status = 1 
			AND p.title = '".$this->dispatcher->getParam('slug')."'
			LIMIT 1";

		$rows = $this->modelsManager->executeQuery($phql);
		$this->post_id = $rows['posts']['id'];	
		$this->title = $rows['posts']['title'];
		$this->view->since = date('j F, Y', strtotime($rows['posts']['since']));
		return $rows;  
	}
	
	public function getimage() {
		$phql = "SELECT
		    name, post_id
			FROM JunMy\Models\Images 
			WHERE post_id = $this->post_id
			LIMIT 5";
		$rows = $this->modelsManager->executeQuery($phql);
		if(count($rows) > 0) {
			echo '<div class="thumbImage"><ul class="jun_thumbnails">';
			foreach($rows as $row) {
				 echo '<li id="'.$row['name'].'"><img src="/ci/uploads/thumnails/'.$row['name'].'" title="" alt="" /></li>';
			}
			echo '</ul></div>';	
		}	
	}
		
	


}

