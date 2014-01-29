<?php

namespace JunMy\Frontend\Controllers;

use JunMy\Components\Pagination\Pagination;
	
class FindController extends ControllerBase {
 
    public $paginationUrl;
    
    public function initialize()
    {
        //Set the document title
        $this->tag->setTitle('Find ads');
        parent::initialize();
    }

	public function indexAction() {
	    
        $this->view->setVar('selected', $_GET);
		$offset = mt_rand(0, 1000);
		$key = 'index'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    // Kalau region == neighbour / entire malaysia, return session
		    // kalau empty session region_id, return 5 (kuala lumpur)
	        if($_GET['region'] == 102 || $_GET['region'] == 112) { 
				if($this->session->has("region_id")) { 
					$id = $this->session->get("region_id");
				} else {
					$id = 5;
				}
			} else {
			    // Kalau region == data table, set session
			    $this->session->set("region_id", $_GET['region']);
				$id = $_GET['region'];
			}
	    	//Top albums
			$phql = 'SELECT
			id,
			name
			FROM JunMy\Models\Regions
			WHERE id = '.$id.'
			LIMIT 1';
			$regions = $this->modelsManager->executeQuery($phql);
	
			$this->view->setVar('regions', $regions);
			$phql = 'SELECT
			id,
			name
			FROM JunMy\Models\Regions
	        WHERE id != '.$id.'
			LIMIT 15';
			$bottoms = $this->modelsManager->executeQuery($phql);
	
			$this->view->setVar('bottoms', $bottoms);
	
			$phql = 'SELECT 
			id, name
			FROM JunMy\Models\Categories 
			LIMIT 20';
			$cats = $this->modelsManager->executeQuery($phql);
	
			$this->view->setVar('cats', $cats);
			
			$this->view->setVar('posts', $this->getselect());
			
			$this->view->paginationUrl = $this->paginationUrl;
			
		}

		$this->view->cache(array("key" => $key));
	}
	
	public function getRegion($id) {
	    		
		if($id == 102) {
			return " AND p.region_id > 0";
		} elseif($id == 112) {
		    $phql = "SELECT 
			neighbourhood
			FROM JunMy\Models\Regions 
			WHERE id = ".
			    ($this->session->has("region_id") ? $this->session->get("region_id") : '5')
				." LIMIT 1";
			$regions = $this->modelsManager->executeQuery($phql);
		    
		    foreach($regions as $in) {
				return " AND p.region_id IN (".$in['neighbourhood'].")";
			}
			
		} else {
			return " AND p.region_id = $id";
		}
	}
	
	public function getCategory($id) {
		if($id == 986750) {
			return " AND p.category_id > 0";
		} elseif($id == '') {
			return " AND p.category_id > 0";
		} else {
			return " AND p.category_id = $id";
		}
	}
	
	public function getselect() {
	    $records_per_page = 20;
	    $paginations = new Pagination();
        $paginate = (($paginations->get_page() - 1) * $records_per_page);
		$phql = "SELECT
		    COUNT(DISTINCT p.id) AS total,
		    p.id, p.title, p.description, p.email, p.region_id, p.category_id,
		    c.name AS cat_name, c.id AS cat_id,
		    r.name AS reg_name, r.id AS reg_id,
		    i.name AS image_name
			FROM JunMy\Models\Tests p
			JOIN JunMy\Models\Categories c
			JOIN JunMy\Models\Regions r
			LEFT OUTER JOIN JunMy\Models\Images i ON(i.post_id = p.id)
			WHERE p.status = 1
			".$this->getCategory($_GET['category']) . $this->getRegion($_GET['region'])."
			GROUP BY p.id";
		$count = $this->modelsManager->executeQuery($phql);	
        $paginations->records(count($count));
        $rows = $this->modelsManager->executeQuery($phql." LIMIT $paginate , $records_per_page");	
        // records per page
        $paginations->records_per_page($records_per_page);
		$this->paginationUrl = $paginations->render();

		return $rows;
	}
	


}

