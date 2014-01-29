<?php

namespace JunMy\Frontend\Controllers;

use JunMy\Components\Pagination\Pagination;


use JunMy\Models\Users;
use JunMy\Models\Postimages;
use JunMy\Models\Posts;
	
class FindController extends ControllerBase {
 
     
    
    public function initialize() { 
        $this->tag->setTitle('Find ads');
        parent::initialize();
    }

	public function indexAction() {
	    
        $this->view->setVar('selected', $_GET);
		$offset = mt_rand(0, 991000);
		$key = 'imall_find_index_'.$offset;
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
	
			
			$phql = 'SELECT
			id,
			name
			FROM JunMy\Models\Regions
	        WHERE id != '.$id.'
			LIMIT 15';
			$bottoms = $this->modelsManager->executeQuery($phql);
			
			$this->view->setVar('regions', $regions);
			$this->view->setVar('bottoms', $bottoms);
	
			$phql = 'SELECT 
			id, name, type, parent, optional
			FROM JunMy\Models\Categories 
			LIMIT 50';
			$cats = $this->modelsManager->executeQuery($phql);
	
			$this->view->setVar('categories', $cats); 
			$this->view->posts = $this->view_ads();
		}
		$this->view->cache(array("key" => $key));
		
	}
	


    /*
	*  Select ads listing on index
	*/
	private function view_ads() { 
		$records_per_page = 10;
	    $paginations = new Pagination();
        $paginate = (($paginations->get_page() - 1) * $records_per_page);
		$phql = "SELECT 
		    p.id AS id, p.title AS title, p.description AS description, p.user_id AS user_id, 
			p.region_id AS region_id, p.category_id AS category_id, p.created AS created,
			p.url AS url, p.price AS price,
		    c.name AS category, c.id AS cat_id,
		    r.name AS region, r.id AS reg_id,
		    i.image_name AS image
			FROM JunMy\Models\Posts AS p
			LEFT JOIN JunMy\Models\Postimages AS i ON(i.post_id = p.id) 
			LEFT JOIN JunMy\Models\Regions AS r ON(p.region_id = r.id)
			LEFT JOIN JunMy\Models\Categories AS c ON(p.category_id = c.id)
			WHERE ".$this->getCategory($_GET['category'])."
			". $this->get_query(filter_input(INPUT_GET, 'title', FILTER_SANITIZE_STRING)). $this->getRegion($_GET['region'])."
			ORDER BY p.id DESC";
		$count = $this->modelsManager->executeQuery($phql);	
        $paginations->records(count($count));
        $rows = $this->modelsManager->executeQuery($phql." LIMIT $paginate , $records_per_page");	
        // records per page
        $paginations->records_per_page($records_per_page); 
        echo '<table>';
        echo $phql;
		foreach($rows as $row) {
			//$cart->AddToBasket($row['id'], 1); //Add an item to the basket  
			//$cart->RemoveFromBasket($row['id'], 1); //Remove item form basket 
			//$cart->DeleteFromBasket($row['id']); //Removes all of item selected 
			//$cart->EmptyBasket($row['id'], 1); //Clear the basket
		?>	  
				<tr>
				    <td><div class="imall_table_image">
					  <a href="view/"<?php echo $row['url']; ?>> 
					  <?php if($row['image'] != '') { ?>
						<img src="<?php echo $this->thumb_image_dir().$row['image']; ?>">
					  <?php } ?>
					  </a>
					  
					  </div></td>
				    <td><h1><a href="ads/<?php echo $row['url']; ?>"><?php echo $row['title']; ?></a></h1>
					<?php if($row['price'] != 0) { ?><p><b>RM<?php echo $row['price']; ?></b></p> <?php } ?>
					</td>
				    
				    <td><p><?php echo date("j F Y g:i a", strtotime($row['created'])); ?></p></td>
				    <td></td>
				</tr> 
			
				
		<?php	
		}
	    ?>
		</table>
		<div class="jun_pagination">
			<?php  $paginations->render(); ?>
		</div> 
		<?php
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
			return " AND p.region_id = '$id'";
		}
	} 
	
	private function get_query($query) {
		if(!empty($query)) {
			return " AND p.title LIKE '%$query%' OR p.description LIKE '%$query%' ";
		}
	}
	
	public function getCategory($id) {
		if($id == 986750) {
			return "p.category_id > '0'";
		} elseif($id == '') {
			return "p.category_id > '0'";
		} else {
			return "p.category_id = '$id'";
		}
	}


}

