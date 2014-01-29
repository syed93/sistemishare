<?php 

namespace JunMy\Frontend\Controllers;

use JunMy\Models\Users;
use JunMy\Models\Posts;
use JunMy\Models\Wallets;
use JunMy\Models\Categories;
use JunMy\Models\Postimages;
use JunMy\Components\Pagination\Pagination; 
use JunMy\Components\ShoppingBasket\ShoppingBasket; 
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
	
	public function indexAction() {
		parent::pageProtect();
		$offset = mt_rand(0, 21000);  
		$key = 'imall_index_'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    $this->view->imall_dir = $this->imall_dir();
			$this->view->setVar('users', $this->get_user($_SESSION['jun_user_auth']['id']));
			 
		}
		
		$this->view->cache(array("key" => $key)); 
	}
	
	public function myadsAction() {
		parent::pageProtect();
		$offset = mt_rand(0, 21000);  
		$key = 'imall_myads_'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    
			$this->view->setVar('users', $this->get_user($_SESSION['jun_user_auth']['id']));
			$this->view->posts = $this->view_ads($_SESSION['jun_user_auth']['id']);
		}
		 
		$this->view->cache(array("key" => $key)); 
	}
	
	public function addAction() {
	    parent::pageProtect();
	    $this->view->urlajax = $this->url->get('ajax/ajaxcategory');
        if($this->request->isPost()) { 
		    if($this->request->getPost('region_id') == 0) {
				$this->flash->error('Please select region');
				
			} elseif($this->request->getPost('category_id') == 0) {
				$this->flash->error('Please select category');
				
			} else { 
			    //print_r($_POST);
				$this->session->set('jun_post_data', $_POST);
				return $this->response->redirect('imall/steptwo');
				
			}
			
			
		} 
		$offset = mt_rand(0, 958695);
		$key = 'imall_add_'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    $this->view->setVar('users', $this->get_user($_SESSION['jun_user_auth']['id'])); 
			$this->view->setVar('regions', $this->region("LIMIT 50")); 
			$this->view->setVar('categories',$this->category("LIMIT 50"));
			
		}
		$this->view->cache(array("key" => $key));
	}
	
	public function steptwoAction() {
		parent::pageProtect();
	    if(isset($_SESSION['jun_post_data'])) {
	     
	        $region = $_SESSION['jun_post_data']['region_id']; 
	        $category = $_SESSION['jun_post_data']['category_id'];
	        $type = $_SESSION['jun_post_data']['type'];
	        
	        // View previous data
			$this->view->setVar('regions', $this->region("WHERE id = '$region' LIMIT 1"));
			$this->view->setVar('categories', $this->category("WHERE id = '$category' LIMIT 1"));
			$this->view->type = $type;
			
			// Submit data on 2nd step
			if($this->request->isPost()) {
			  
			  
				if(strlen($this->request->getPost('title')) > 64 || strlen($this->request->getPost('title')) < 5) {
					$this->flash->error('Title must between 5 - 64 character'); 
				} elseif(strlen($this->request->getPost('body')) < 3) {
					$this->flash->error('Minimum description 3 character'); 
				} elseif(strlen($this->request->getPost('location')) < 3) {
					$this->flash->error('Please enter item location'); 
				} elseif($this->request->getPost('item_condition') == '0') {
					$this->flash->error('Please select Item Condition'); 
				} else {
				    $url = $this->slug($this->request->getPost('title')).'-'.date('YmdHis');
				    //insert post to database
				    $posts = new Posts();  
					$posts->title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);  
					$posts->description = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_SPECIAL_CHARS);  
					$posts->location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_SPECIAL_CHARS); 
					$posts->item_condition = $cond = ($this->request->getPost('item_condition') == '' ? 0 : $this->request->getPost('item_condition'));
					$posts->price = $price = ($this->request->getPost('price') == '' ? 0 : $this->request->getPost('price'));  
					$posts->category_id = $category;  
					$posts->region_id = $region;  
					$posts->user_id = $_SESSION['jun_user_auth']['id']; 
					$posts->created = date('Y-m-d H:i:s'); 
					$posts->url = $url;  
					$posts->type = $type;
					$posts->status = 0; 
					$posts->note = NULL;
					$posts->enable_jcart = 0;
					if (!$posts->save()) {
			            foreach ($posts->getMessages() as $message) {
			                $this->flash->error((string) $message);
			            }
			
			        } else {  
			            $post_id = $posts->id;
					    if($this->request->hasFiles() == true) {  
						    
						    $count = count($_FILES['image']['name']);
						    
							for($i=0; $i<=$count; $i++) {
								if($_FILES['image']['name'][$i] != '') {
								    if($_FILES['image']['size'][$i] < (4096 * 4096)) {
										$extension  = pathinfo($_FILES['image']['name'][$i], PATHINFO_EXTENSION); 
									    $allow_ext = array('jpg', 'jpeg', 'png');
									    if(in_array($extension, $allow_ext)) {
											// IE: 98YUIY78TY87UY8T8U.jpg
											$rename = date('YmdHis').$post_id.$i.".".$extension;
											$path = 'uploads/imall/images/';
							    			$thumb ='uploads/imall/thumbnails/';
											if(move_uploaded_file($_FILES['image']['tmp_name'][$i], $path.$rename)) {
												if($this->save_image($post_id, $rename)) {
													if($this->resize_image($path, $rename, 675, 675, 675)) {
														if($this->thumb($path, $rename, $thumb)) {
															$this->response->redirect('imall/finish/'.$url);
														} else {
															$this->flash->error('Error on Thumbs EOT908');
														}
													} else {
														$this->flash->error('Error on Upload EOT905');
													}
													 
													
													
												} else {
													$this->flash->error('Error on save files ESF635');
												}  	
											} else {
												$this->flash->error('Error on upload files EUF324');
											}	
										} else {
											$this->flash->error('Invalid file extension');	
										}	
									} else {
										$this->flash->error('Maximum image size is 4mb');
									}  
								}  
							}  
						} else {
							// Redirect to finish page even no image was upload
						    $this->response->redirect('imall/finish/'.$url);	
						} 
					}
					
				}
			}
			
			
		} else {
			return $this->response->redirect('imall/add');
		}  
		
		$offset = mt_rand(0, 921000);  
		$key = 'imall_steptwo_'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    
			$this->view->setVar('users', $this->get_user($_SESSION['jun_user_auth']['id']));
			 
		} 
		$this->view->cache(array("key" => $key)); 
	}
	
	public function finishAction() {
		parent::pageProtect();
	    if(count($this->view_ad($this->dispatcher->getParam('slug'))) > 0) {
			$this->view->setVar('posts', $this->view_ad($this->dispatcher->getParam('slug')));
		} else {
			return $this->response->redirect('imall/add');
		}  
		
		$offset = mt_rand(0, 921000);  
		$key = 'imall_steptwo_'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    
			$this->view->setVar('users', $this->get_user($_SESSION['jun_user_auth']['id']));
			//$this->view->setVar('images', $this->thumbnail()); 
		} 
		$this->view->cache(array("key" => $key));
		$this->view->image = $this->getimage();
		$this->view->urlajax = $this->url->get('ajax/ajaximall');
		unset($_SESSION['jun_post_data']);
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
	    $save->default_image = 0;
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
	private function view_ads($user_id) {
		$records_per_page = 15;
	    $paginations = new Pagination();
        $paginate = (($paginations->get_page() - 1) * $records_per_page);
		$phql = "SELECT
		    p.id AS id, p.title AS title, p.price AS price,  
		    p.created AS created, p.url AS url, p.type AS type, p.status AS status, p.note AS note,
		    i.image_name AS image 
			FROM JunMy\Models\Posts AS p
			LEFT JOIN JunMy\Models\Postimages AS i ON(i.post_id = p.id)
			WHERE p.user_id = '$user_id'
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
					  <?php if($row['image'] != '') { ?>
						<img src="<?php echo $this->thumb_image_dir().$row['image']; ?>"></a>
					  <?php } ?>
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