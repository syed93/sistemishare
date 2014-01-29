<?php 

namespace JunMy\Frontend\Controllers;

use JunMy\Models\Users;
use JunMy\Models\Posts;
use JunMy\Models\Wallets;
use JunMy\Models\Categories;
use JunMy\Models\Postimages;
use JunMy\Components\Pagination\Pagination; 
use JunMy\Components\Thumbnail\Thumbnail;

class ImallController extends ControllerBase {
	
	public $paginationUrl;
	
	private $post_id;
	
	private $title;
	
	public $date;
	
	public $index_date;
	
	public function initialize() {
		$this->tag->setTitle('iMall');
		parent::initialize();
	}
	
	public function dindexAction() {
		parent::pageProtect();
		$offset = mt_rand(0, 21000);  
		$key = 'imall_index_'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    $this->view->imall_dir = $this->imall_dir();
			$this->view->setVar('users', $this->get_user($_SESSION['junauth']['id'])); 
		}
		
		$this->view->cache(array("key" => $key)); 
	}
	
	public function indexAction() {
		parent::pageProtect();
		$offset = mt_rand(0, 21000);  
		$key = 'imall_ads_'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    
			$this->view->setVar('users', $this->get_user($_SESSION['jun_user_auth']['id']));
			$records_per_page = 15;
	    $paginations = new Pagination();
        $paginate = (($paginations->get_page() - 1) * $records_per_page);
		$phql = "SELECT
		    p.id AS id, p.title AS title, p.price AS price,  
		    p.created AS created, p.url AS url, p.type AS type, p.status AS status, p.note AS note,
		    i.image_name AS image 
			FROM JunMy\Models\Posts AS p
			INNER JOIN JunMy\Models\Postimages AS i ON(i.post_id = p.id)
			WHERE p.status = 0
			ORDER BY p.id DESC";
		$count = $this->modelsManager->executeQuery($phql);	
        $paginations->records(count($count));
        $rows = $this->modelsManager->executeQuery($phql." LIMIT $paginate , $records_per_page");	
        // records per page
        $paginations->records_per_page($records_per_page); 
        foreach($rows as $row) {
		?>	 <table>  
				<tr>
				    <td><div class="imall_table_image">
					  <a href="view/"<?php echo $row['url']; ?>>
					  <img src="<?php echo $this->thumb_image_dir().$row['image']; ?>"></a>
					  </div></td>
				    <td><h1><a href="view/<?php echo $row['url']; ?>"><?php echo $row['title']; ?></a></h1>
					<?php if($row['price'] != 0) { ?><p><b>RM<?php echo $row['price']; ?></b></p> <?php } ?>
					</td>
				    
				    <td><p><?php echo date("j F Y g:i a", strtotime($row['created'])); ?></p></td>
				    <td></td>
				</tr> 
			</table>
				
		<?php	
		}
	    ?>
		<div class="jun_pagination">
			<?php echo $paginations->render(); ?>
		</div> 
		<?php
			
		}
		 
		$this->view->cache(array("key" => $key)); 
	} 
	
	public function viewAction() {
		parent::pageProtect();
	    if(count($this->view_ad($this->dispatcher->getParam('slug'))) > 0) {
			$this->view->setVar('posts', $this->view_ad($this->dispatcher->getParam('slug')));
		} else {
			return $this->response->redirect('imall/add');
		}  
		
		$offset = mt_rand(0, 921000);  
		$key = 'imall_view_'.$this->dispatcher->getParam('slug').'_'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    
			$this->view->setVar('users', $this->get_user($_SESSION['jun_user_auth']['id']));
			$this->view->host = $this->host();
		} 
		$this->view->cache(array("key" => $key));
		$this->view->image = $this->getimage();
		$this->view->urlajax = $this->url->get('ajax/ajaximall');
		$this->view->date = $this->date;
		$this->view->image_dir = $this->imall_image_dir();
	}
	
	/*
	*  Count ads for preview and view
	*/
	private function view_ad($param) {
		$phql = "SELECT 
		  p.id AS id, p.title AS title, p.description AS description, p.price AS price,  
		  p.created AS created, p.url AS url, p.type AS type, p.status AS status, p.note AS note,
		  i.image_name AS image,
		  r.name AS region,
		  c.name AS category,
		  u.username AS username, u.name AS name, u.telephone AS telephone, u.created AS created, 
		  u.address AS address, u.email AS email
		  FROM JunMy\Models\Posts AS p
		  INNER JOIN JunMy\Models\Users AS u ON(u.id = p.user_id)
		  LEFT JOIN JunMy\Models\Postimages AS i ON(p.id = i.post_id) 
		  LEFT JOIN JunMy\Models\Categories AS c ON(c.id = p.category_id) 
		  LEFT JOIN JunMy\Models\Regions AS r ON(r.id = p.region_id) 
		  WHERE p.url = '$param' LIMIT 1";
		$rows = $this->modelsManager->executeQuery($phql); 
		foreach($rows as $row) {
			$this->post_id = $row['id']; 
			$this->title = $row['title'];
			$this->date = date("j F Y g:i a", strtotime($row['created']));
		}
		return $rows;
	}
	
	public function getimage() {
		$phql = "SELECT
		    post_id, image_name
			FROM JunMy\Models\Postimages 
			WHERE post_id = '$this->post_id'
			LIMIT 5";
		$rows = $this->modelsManager->executeQuery($phql);
		if(count($rows) > 1) {
			echo '<div class="thumbImage"><ul class="jun_thumbnails">';
			foreach($rows as $row) {
				 echo '<li id="'.$row['image_name'].'"><img src="'.$this->thumb_image_dir().$row['image_name'].'" title="'.$this->title.'" alt="'.$this->title.'" /></li>';
			}
			echo '</ul></div>';	
		}	
	}
	
	
	
	/*
	*  Insert new post
	*  Used on steptwoAction
	*/
	private function save_image($id, $img_name) {
	    $save = new Postimages();
	    $save->post_id = $id;
	    $save->image_name = $img_name;
	    if($save->save()) {
			return true;
		} else {
			return false;
		}
	    
	} 
	
	/*
	*  Select user WHERE user_id = $_SESSION
	*/
	private function get_user($id) {
	    $phql = "SELECT u.username AS username, u.name AS name, u.telephone AS telephone, u.created AS created, 
		  u.address AS address, u.email AS email, u.insuran_due_date AS insuran_due_date, 
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
	
	/*
	*  Select ads listing on index
	*/
	private function view_ads($param) {
		$records_per_page = 15;
	    $paginations = new Pagination();
        $paginate = (($paginations->get_page() - 1) * $records_per_page);
		$phql = "SELECT
		    p.id AS id, p.title AS title, p.price AS price,  
		    p.created AS created, p.url AS url, p.type AS type, p.status AS status, p.note AS note,
		    i.image_name AS image 
			FROM JunMy\Models\Posts AS p
			LEFT JOIN JunMy\Models\Postimages AS i ON(i.post_id = p.id)
			WHERE '$param'
			ORDER BY p.id DESC";
		$count = $this->modelsManager->executeQuery($phql);	
        $paginations->records(count($count));
        $rows = $this->modelsManager->executeQuery($phql." LIMIT $paginate , $records_per_page");	
        // records per page
        $paginations->records_per_page($records_per_page); 
        foreach($rows as $row) {
		?>	 <table>  
				<tr>
				    <td><div class="imall_table_image">
					  <a href="view/"<?php echo $row['url']; ?>>
					  <img src="<?php echo $this->thumb_image_dir().$row['image']; ?>"></a>
					  </div></td>
				    <td><h1><a href="view/<?php echo $row['url']; ?>"><?php echo $row['title']; ?></a></h1>
					<?php if($row['price'] != 0) { ?><p><b>RM<?php echo $row['price']; ?></b></p> <?php } ?>
					</td>
				    
				    <td><p><?php echo date("j F Y g:i a", strtotime($row['created'])); ?></p></td>
				    <td></td>
				</tr> 
			</table>
				
		<?php	
		}
	    ?>
		<div class="jun_pagination">
			<?php echo $paginations->render(); ?>
		</div> 
		<?php
	}
	
	/*
	*  Select CATEGORY Condition as parameter 
	*/
	private function category($cond = NULL) {
		$phql = "SELECT 
			id, name, type, parent
			FROM JunMy\Models\Categories 
			$cond";
		return $this->modelsManager->executeQuery($phql);
	}
	
	/*
	*  Select REGION Condition as parameter 
	*/
	private function region($cond = NULL) {
		$phql = "SELECT
			id,
			name
			FROM JunMy\Models\Regions
			$cond";
		return $this->modelsManager->executeQuery($phql);
	}
	
	private function resize_image($path, $name, $width, $height, $default) {
	    $thumb=new Thumbnail("./" . $path . $name);		
        $thumb->size_width($width);				
        $thumb->size_height($height);				
        $thumb->size_auto($default);				
        $thumb->jpeg_quality(100);				
        //$thumb->show();						
        $thumb->save("./". $path . $name);
		unset($thumb);
		return true;
	}
	
	private function thumb($open_path, $name, $save_path) {
	    $thumb=new Thumbnail("./" . $open_path . $name);		
        $thumb->size_width(100);				
        $thumb->size_height(100);				
        $thumb->size_auto(100);				
        $thumb->jpeg_quality(100);				
        //$thumb->show();						
        $thumb->save("./". $save_path . $name);
		unset($thumb);
		return true;
	}
	
    /*	
		Function resize($filename_original,$filename_resized,$new_w,$new_h)
	    creates a resized image
	    variables:
	    $filename_original    Original filename
	    $filename_resized    Filename of the resized image
	    $new_w        width of resized image
	    $new_h        height of resized image
    */    
	public function resize($filename_original, $filename_resized, $new_w, $new_h) {
	    $extension = pathinfo($filename_original, PATHINFO_EXTENSION);
	 
	    if ( preg_match("/jpg|jpeg/", $extension) ) $src_img=@imagecreatefromjpeg($filename_original);
	 
	    if ( preg_match("/png/", $extension) ) $src_img=@imagecreatefrompng($filename_original);
	 
	    if(!$src_img) return false;
	 
	    $old_w = imageSX($src_img);
	    $old_h = imageSY($src_img);
	 
	    $x_ratio = $new_w / $old_w;
	    $y_ratio = $new_h / $old_h;
	 
	    if ( ($old_w <= $new_w) && ($old_h <= $new_h) ) {
	        $thumb_w = $old_w;
	        $thumb_h = $old_h;
	    }
	    elseif ( $y_ratio <= $x_ratio ) {
	        $thumb_w = round($old_w * $y_ratio);
	        $thumb_h = round($old_h * $y_ratio);
	    }
	    else {
	        $thumb_w = round($old_w * $x_ratio);
	        $thumb_h = round($old_h * $x_ratio);
	    }        
	 
	    $dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
	    imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_w,$old_h); 
	 
	    if (preg_match("/png/",$extension)) imagepng($dst_img,$filename_resized); 
	    else imagejpeg($dst_img,$filename_resized,100); 
	 
	    imagedestroy($dst_img); 
	    imagedestroy($src_img);
	 
	    return true;
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