<?php

namespace JunMy\Frontend\Controllers;

use JunMy\Models\Users;
use JunMy\Models\Wallets;
use JunMy\Models\Insuran;

class UsersController extends ControllerBase {
	
	public $form;
	
	public $jun_error = array();
	
	public $due;
	
	public $salt_length = 9;
	
	public function initialize() {
		$this->tag->setTitle('User register/login');
		parent::initialize();
	}
	
	public function indexAction() {
	    parent::pageProtect();
		
		$offset = mt_rand(0, 958695);
		$key = 'userlogin'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    
			$this->view->setVar('users', $this->get_user($_SESSION['jun_user_auth']['id']));
			$this->view->blink = $this->blink_notification($this->due);
		}
		
		$this->view->cache(array("key" => $key));
		
	}
	
	private function get_user($id) {
	    $phql = "SELECT * FROM JunMy\Models\Users WHERE id = '$id' LIMIT 1";
		$rows = $this->modelsManager->executeQuery($phql);
		//$this->view->since = date('j F, Y', strtotime($rows['users']['created']));
		foreach($rows as $key => $row) {
			$this->due = $key['created'];
		}
		return $rows;
	}
	
	private function blink_notification($date) {
	    $time = strtotime($date);
        $final = date("Y-m-d", strtotime("-1 month", $time));
        if(date("Y-m-d") >= $final || date("Y-m-d") >= $time) {
			$color = 'red_bg';
		} else {
			$color = 'green_bg';
		}
		return $color;
	}

    public function loginAction() {
		if ($this->request->isPost()) {
            $username = $this->request->getPost('username');
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
	
	public function _registerSession($user)
    {
        $this->session->set('jun_user_auth', array(
            'id' => $user->id,
            'username' => $user->username
        ));
    }
	
	public function display($value) {
        if(isset($_POST['submit'])) {
		    if(isset($this->jun_error[$value])) {
			    echo '<span class="ValidationErrors">'.$this->jun_error[$value].'</span>'; 
		    }			
		}
    }
	

    
    public function registerAction() {
        if($this->request->isPost()) { 
			$this->rules(array(
				'username_sponsor' => array('is_exist' => array('table' => 'users', 'field' => 'username', 'error' => 'Username tidak wujud')),
				'username' => array('between' => array('min' => 6, 'max' => 18, 'error' => 'ID Pengguna 6 hingga 18 karakter'),
				                    'is_uniq' => array('table' => 'users', 'field' => 'username', 'error' => 'Username telah didaftarkan'),
									'alphanumeric' => 'ID Pengguna tidak sah A-Z, a-z, 0-9 sahaja'),
				'name' => array('not_empty' => 'Sila isi nama penuh'), 
				'password' => array('between' => array('min' => 6, 'max' => 18, 'error' => 'Kata laluan 6 hingga 18 aksara')), 
				'retype_password' => array('equal_to' => 'password', 'error' => 'Kata laluan tidak sepadan'),
				'nric_new' => array('numeric' => 'No K/P tidak sah, Sila masukkan nombor sahaja',
				                    'between' => array('min' => 11, 'max' => 13, 'error' => 'No K/P tidak sah')), 
				'kin_name' => array('not_empty' => 'Nama waris wajib diisi'),
				'relation' => array('not_empty' => 'Hubungan dengan waris wajib diisi'),
				'nric_new_kin' => array('numeric' => 'No K/P tidak sah, Sila masukkan nombor sahaja',
				                 'between' => array('min' => 11, 'max' => 13, 'error' => 'No K/P tidak sah')), 
				'address' => array('not_empty' => 'Alamat wajib diisi'),
				'postcode' => array('numeric' => 'Poskod, Sila masukkan nombor sahaja',
				                    'between' => array('min' => 4, 'max' => 6, 'error' => 'Poskod tidak sah')),
				'telephone' => array('numeric' => 'Nombor sahaja contoh: 0121234567',
				                    'between' => array('min' => 9, 'max' => 12, 'error' => 'Nombor telefon 10 - 12 karakter')),
				'email' => array('is_email' => 'Email tidak sah'),
				'road_tax' => array('not_empty' => 'Sila isi amaun cukai jalan'),
				'insuran_due_date' => array('not_empty' => 'Sila isi tarikh tamat tempoh insuran'),
				'reg_number' => array('not_empty' => 'Sila isi nombor pendaftaran kenderaan',
				                      'is_uniq' => array('table' => 'users', 'field' => 'reg_number', 'error' => 'No pendaftaran telah didaftarkan')),
				'owner_name' => array('not_empty' => 'Sila isi pemilik pendaftaran kenderaan'),
				'owner_nric' => array('numeric' => 'Sila masukkan nombor sahaja',
				                    'between' => array('min' => 10, 'max' => 13, 'error' => 'No K/P tidak sah')),
				'owner_dob' => array('not_empty' => 'Sila isi tarikh lahir pemilik kenderaan'),
				'model' => array('not_empty' => 'Sila isi model kenderaan'),
				'year_make' => array('not_empty' => 'Sila isi tahun kenderaan dibuat',
				                     'numeric' => 'Sila masukkan nombor sahaja'),
				'capacity' => array('not_empty' => 'Sila isi kapasiti enjin (CC)',
				                     'numeric' => 'Sila masukkan nombor sahaja (0-9)'),  
				'engine_number' => array('not_empty' => 'Sila isi nombor enjin kenderaan'), 
				'chasis_number' => array('not_empty' => 'Sila isi nombor chasis kenderaan'), 
				'grant_serial_number' => array('not_empty' => 'Sila isi nombor siri geran kenderaan') 
			));
		
			
		if(empty($this->jun_error)) {
			$users = new Users();
			$users->username_sponsor = $this->request->getPost('username_sponsor'); 
			$users->username = $this->request->getPost('username'); 
			$users->name = $this->request->getPost('name'); 
			$users->password = $this->passwordHash($this->request->getPost('password')); 
			$users->nric_new = $this->request->getPost('nric_new'); 
			$users->kin_name = $this->request->getPost('kin_name'); 
			$users->relation = $this->request->getPost('relation'); 
			$users->nric_new_kin = $this->request->getPost('nric_new_kin'); 
			$users->bank_number = $this->request->getPost('bank_number'); 
			$users->bank_name = $this->request->getPost('bank_name'); 
			$users->address = $this->request->getPost('address'); 
			$users->postcode = $this->request->getPost('postcode'); 
			$users->telephone = $this->request->getPost('telephone'); 
			$users->email = $this->request->getPost('email'); 
			$users->previous_insuran_company = $this->request->getPost('previous_insuran_company'); 
			$users->cover_note = $this->request->getPost('cover_note'); 
			$users->insuran_ncb = $this->request->getPost('insuran_ncb');
			$users->insuran_due_date = $this->request->getPost('insuran_due_date'); 
			$users->reg_number = $this->request->getPost('reg_number'); 
			$users->owner_name = $this->request->getPost('owner_name'); 
			$users->owner_nric = $this->request->getPost('owner_nric'); 
			$users->owner_dob = $this->request->getPost('owner_dob'); 
			$users->model = $this->request->getPost('model'); 
			$users->year_make = $this->request->getPost('year_make'); 
			$users->capacity = $this->request->getPost('capacity'); 
			$users->created = date('Y-m-d H:i:s'); 
			$users->engine_number = $this->request->getPost('engine_number'); 
			$users->chasis_number = $this->request->getPost('chasis_number'); 
			$users->grant_serial_number = $this->request->getPost('grant_serial_number'); 
			$users->ip_address = $this->get_ip();  
			$users->payment = 0; 
			$users->verified = 0;
			$users->road_tax = $this->request->getPost('road_tax');
			$users->email_verification = $this->passwordHash(date('Y-m-d H:i:s'));
			$users->ckey = 0;
			$users->ctime = 0;
			$users->profile_image = 'nophoto.jpg';
			$users->sms_setting = 1;
			if ($users->save()) {
			    $last_id = $users->id;
			    if($this->insert_wallet($last_id)) {
					if($this->insert_insuran($last_id, $this->request->getPost('insuran_due_date'))) {
						$this->flash->success("Registration has been success");
	            		//return $this->response->redirect('users/steptwo');
					}
				}
			    
	            
	        } else {
	            foreach ($users->getMessages() as $message) {
	                $this->flash->error((string) $message);
	            }
	        }
			
		}
        }
		$offset = mt_rand(0, 958695);
		$key = 'userregister'.$offset;
		$exists = $this->view->getCache()->exists($key);
		if (!$exists) {
		    
			$this->view->form = $this->register_form();
		}
		
		$this->view->cache(array("key" => $key));
	}
	
	private function insert_wallet($id) {
		$wallet = new Wallets();
		$wallet->user_id = $id;
		$wallet->amount = 0.00;
		return $wallet->save();
	}
	
	private function insert_insuran($id, $due_date) {
	 //`user_id`, `insurance`, `road_tax`, `cover`, `service_charge`, `total`, `next_renewal`, `created`, `pic`
		$ins = new Insuran();
		$ins->user_id = $id;
		$ins->insurance = 0.00;
		$ins->road_tax = 0.00;
		$ins->cover = 0.00;
		$ins->service_charge = 0.00;
		$ins->total = 0.00;
		$ins->next_renewal = $due_date;
		$ins->created = date('Y-m-d H:i:s');
		$ins->pic = 0;
		return $ins->save();
	}
	
	public function passwordHash($pwd, $salt = null) {
        if ($salt === null)     {
            $salt = substr(md5(uniqid(rand(), true)), 0, $this->salt_length);
        } else {
            $salt = substr($salt, 0, $this->salt_length);
        }
        return $salt . sha1($pwd . $salt);
    }
    
    public function get_ip() {
		$ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
 
        return $ipaddress;
	}
	
	private function register_form() {
	 
	    if($this->session->get('referral')) {
	        $ref_username = $this->session->get('referral');
		} else {
			$ref_username = 'admin';
		}
		?>
		<script type="text/javascript">
        $(function() {
            $('#no_engin').click(function() {
	        $('.no_engin').toggle();
	        return false;
            });
            $('#no_chasis').click(function() {
	        $('.no_chasis').toggle();
	        return false;
            });
            $('#no_siri').click(function() {
	        $('.no_siri').toggle();
	        return false;
            });
            $('#pra_daftar').click(function() {
	        $('.pra_daftar').toggle();
	        return false;
            });
            $('#e_pin').click(function() {
	        $('.e_pin').toggle();
	        return false;
            });
            $('#online_banking').click(function() {
	        $('.online_banking').toggle();
	        return false;
            });
        });
        
    </script>
		<form action="" method="POST">
	
		
		<fieldset>
		<legend>Maklumat Penaja</legend>
		<table>
		  <tr>
		    <td><p>Username Penaja <b class="required">*</b></p></td>
			<td><input type="text" name="username_sponsor" id="username_sponsor" value="<?=filter_input(INPUT_POST, 'username_sponsor', FILTER_SANITIZE_STRING)?>"><?php $this->display('username_sponsor'); ?>
			<div id="message_sponsor"></div></td>
		  </tr>		  
		</table>
		</fieldset>
        
		
		<fieldset>
		<legend>Maklumat Peribadi</legend>
		<table>
		  <tr>
		    <td><p>ID Pilihan <b class="required">*</b></p></td>
			<td><input type="text" name="username" id="username" placeholder="A-Z, a-z, 0-9" value="<?=filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING)?>">
			<?php $this->display('username'); ?><div id="message"></div></td>
		  </tr>
		  <tr>
		    <td><p>Nama <b class="required">*</b></p></td>
			<td><input type="text" name="name" placeholder="Ali Bin Abu" value="<?=filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING)?>">
			<?php $this->display('name'); ?></td>
		  </tr>
		  <tr>
		    <td><p>Kata Laluan <b class="required">*</b></p></td>
			<td><input type="password" name="password" value="<?=filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING)?>">
			<?php $this->display('password'); ?></td>
		  </tr>
		  <tr>
		    <td><p>Ulang Kata Laluan <b class="required">*</b></p></td>
			<td><input type="password" name="retype_password" value="<?=filter_input(INPUT_POST, 'retype_password', FILTER_SANITIZE_STRING)?>">
			<?php $this->display('retype_password'); ?></td>
		  </tr>
		  <tr>
		    <td><p>No K/P(Baru) <b class="required">*</b></p></td><td><input type="text" name="nric_new" placeholder="801230106574" value="<?=filter_input(INPUT_POST, 'nric_new', FILTER_SANITIZE_STRING)?>">
			<?php $this->display('nric_new'); ?></td>
		  </tr>
		  
		  <tr>
		    <td><p>Nama Waris <b class="required">*</b></p></td><td><input type="text" name="kin_name" placeholder="Nama Isteri/Anak" value="<?=filter_input(INPUT_POST, 'kin_name', FILTER_SANITIZE_STRING)?>">
			<?php $this->display('kin_name'); ?></td>
		  </tr>
		  <tr>
		    <td><p>Hubungan</p></td><td><input type="text" name="relation" placeholder="Isteri/Anak" value="<?=filter_input(INPUT_POST, 'relation', FILTER_SANITIZE_STRING)?>">
			<?php $this->display('relation'); ?></td>
		  </tr>
		  <tr>
		    <td><p>No K/P Waris(Baru) <b class="required">*</b></p></td><td><input type="text" name="nric_new_kin" placeholder="801230106574" value="<?=filter_input(INPUT_POST, 'nric_new_kin', FILTER_SANITIZE_STRING)?>">
			<?php $this->display('nric_new_kin'); ?></td>
		  </tr>
		  
		  <tr>
		    <td><p>No Akaun Bank</p></td><td><input type="text" name="bank_number" value="<?=filter_input(INPUT_POST, 'bank_number', FILTER_SANITIZE_STRING)?>" placeholder="CIMB/Maybank/Dll"></td>
		  </tr>
		  <tr>
		    <td><p>Nama Bank</p></td><td><input type="text" name="bank_name" value="<?=filter_input(INPUT_POST, 'bank_name', FILTER_SANITIZE_STRING)?>" placeholder="CIMB/Maybank/Dll"></td>
		  </tr>
		  
		</table>
		</fieldset>
		
		<fieldset>
		<legend>Maklumat Untuk Dihubungi</legend>
		<table>
		  <tr>
		    <td><p>Alamat Surat Menyurat<b class="required">*</b></p></td><td><textarea name="address"><?=filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING)?></textarea></td>
		  </tr>
		  <tr>
		    <td><p>Poskod<b class="required">*</b></p></td><td><input type="text" name="postcode" placeholder="43020" value="<?=filter_input(INPUT_POST, 'postcode', FILTER_SANITIZE_STRING)?>">
			<?php $this->display('postcode'); ?></td>
		  </tr>
		  <tr>
		    <td><p>No Telefon Bimbit<b class="required">*</b></td><td><input type="text" name="telephone" placeholder="0123456789" value="<?=filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING)?>">
			<?php $this->display('telephone'); ?></td>
		  </tr>
		  
		  <tr>
		    <td><p>Email<b class="required">*</b></td><td><input type="text" name="email" placeholder="nama@email.com" value="<?=filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING)?>">
			<?php $this->display('email'); ?></td>
		  </tr>
		  
		</table>
		</fieldset>
		
	

	
		<fieldset>
		<legend>Maklumat Insuran Terdahulu</legend>
		<table>
		  <tr>
		    <td><p>Syarikat Insuran</p></td><td><input type="text" name="previous_insuran_company" placeholder="Contoh: Takaful Ikhlas" value="<?=filter_input(INPUT_POST, 'previous_insuran_company', FILTER_SANITIZE_STRING)?>"></td>
		  </tr>
		  <tr>
		    <td><p>No Nota Perlindungan</p></td><td><input type="text" name="cover_note" value="<?=filter_input(INPUT_POST, 'cover_note', FILTER_SANITIZE_STRING)?>"></td>
		  </tr>
		  <tr>
		    <td><p>NCD</p></td><td><select name="insuran_ncb">
			                       <option value="">Pilih</option>
			                       <option value="0">0%</option>
			                       <option value="25">25%</option>
			                       <option value="30">30%</option>
			                       <option value="38.33">38.33%</option>
			                       <option value="45">45%</option>
			                       <option value="55">55%</option>
			                       </select>
			</td>
		  </tr>
		  <tr>
		    <td><p>Cukai Jalan(RM)<b class="required">*</b></p></td><td><input type="text" name="road_tax" placeholder="Contoh: 120.90" value="<?=filter_input(INPUT_POST, 'road_tax', FILTER_SANITIZE_STRING)?>">
			<?php $this->display('road_tax'); ?></td>
		  </tr>
		  <tr>
		    <td><p>Tarikh tamat insuran<b class="required">*</b></p></td><td><input type="text" name="insuran_due_date" id="datepicker" value="<?=filter_input(INPUT_POST, 'insuran_due_date', FILTER_SANITIZE_STRING)?>">
			<?php $this->display('insuran_due_date'); ?></td>
		  </tr>
		  
		</table>
		</fieldset>
		
		<fieldset>
		<legend>Maklumat Kenderaan</legend>
		<table>
		  <tr>
		    <td><p>No Pendaftaran<b class="required">*</b></p></td><td><input type="text" name="reg_number" placeholder="Contoh: WWW1234" value="<?=filter_input(INPUT_POST, 'reg_number', FILTER_SANITIZE_STRING)?>">
			<?php $this->display('reg_number'); ?></td>
		  </tr>
		  <tr>
		    <td><p>Nama Pemilik<b class="required">*</b></p></td><td><input type="text" name="owner_name" placeholder="Contoh: Ali Bin Kasim" value="<?=filter_input(INPUT_POST, 'owner_name', FILTER_SANITIZE_STRING)?>">
			<?php $this->display('owner_name'); ?></td>
		  </tr>
		  <tr>
		    <td><p>No K/P Pemilik<b class="required">*</b></p></td><td><input type="text" name="owner_nric" placeholder="Contoh: 801231105645" value="<?=filter_input(INPUT_POST, 'owner_nric', FILTER_SANITIZE_STRING)?>">
			<?php $this->display('owner_nric'); ?></td>
		  </tr>
		  <tr>
		    <td><p>Tarikh Lahir Pemilik<b class="required">*</b></p></td><td><input type="text" name="owner_dob" placeholder="Contoh: 21 Julai 1980" value="<?=filter_input(INPUT_POST, 'owner_dob', FILTER_SANITIZE_STRING)?>">
			<?php $this->display('owner_dob'); ?></td>
		  </tr>
		  <tr>
		    <td><p>Model<b class="required">*</b></p></td><td><input type="text" name="model" placeholder="Contoh: Perodua Alza" value="<?=filter_input(INPUT_POST, 'model', FILTER_SANITIZE_STRING)?>">
			<?php $this->display('model'); ?></td>
		  </tr>
		  <tr>
		    <td><p>Tahun Dibuat<b class="required">*</b></td><td><input type="text" name="year_make" placeholder="Contoh: 2010" value="<?=filter_input(INPUT_POST, 'year_make', FILTER_SANITIZE_STRING)?>">
			<?php $this->display('year_make'); ?></td>
		  </tr>
		  
		  <tr>
		    <td><p>Kapasiti Enjin<b class="required">*</b></p></td><td><input type="text" name="capacity" placeholder="Contoh: 1989" value="<?=filter_input(INPUT_POST, 'capacity', FILTER_SANITIZE_STRING)?>">
			<?php $this->display('capacity'); ?></td>
		  </tr>
		  <tr>
		    <td><p>No Enjin <b class="required">*</b><a href="#" id="no_engin"><img src="../images/help_icon.png"></a></p></td><td><input type="text" name="engine_number" placeholder="K20A9487345" value="<?=filter_input(INPUT_POST, 'engine_number', FILTER_SANITIZE_STRING)?>">
			<?php $this->display('engine_number'); ?>
			</td>
		  </tr>
		  <tr>
		    <td></td><td> <div class="no_engin" style="display:none; background-color:#4CF;width:240px;height:120px;"><img src="../images/chasis.jpg"></div></td>
		  </tr>
		  <tr>
		    <td><p>No Chasis <b class="required">*</b><a href="#" id="no_chasis"><img src="../images/help_icon.png"></a></p></td><td><input type="text" name="chasis_number" placeholder="M8945U85957" value="<?=filter_input(INPUT_POST, 'chasis_number', FILTER_SANITIZE_STRING)?>">
			<?php $this->display('chasis_number'); ?>
			</td>
		  </tr>
		  <tr>
		    <td></td><td> <div class="no_chasis" style="display:none; background-color:#4CF;width:240px;height:120px;"><img src="../images/chasis.jpg"></div></td>
		  </tr>
		  <tr>
		    <td><p>No Siri Geran <b class="required">*</b><a href="#" id="no_siri"><img src="../images/help_icon.png"></a></p></td><td><input type="text" name="grant_serial_number" placeholder="1234567" value="<?=filter_input(INPUT_POST, 'grant_serial_number', FILTER_SANITIZE_STRING)?>">
			<?php $this->display('grant_serial_number'); ?>
			</td>
		  </tr>
		  <tr>
		    <td></td><td> <div class="no_siri" style="display:none; background-color:#4CF;width:240px;height:120px;"><img src="../images/no_siri.jpg"></div></td>
		  </tr>
		  
		</table>
		</fieldset>
		

		
		<fieldset>
		<legend>Daftar</legend>
		<table>
		  <tr>
		    <td><input type="submit" name="submit" value="Daftar"></td><td></td>
		  </tr>
		  
		</table>
		</fieldset>
		
		</form>
		<?php
	}
	
	public function rules($data) {
        if(isset($_POST)) {
			foreach($data as $key => $value) {
			//echo $_POST[$key] . $value;
				foreach($value as $rule => $error) {
					//echo $rule;
					switch($rule) {
						case 'not_empty':
						    if(empty($_POST[$key]) == $key) {
								$this->jun_error[$key] = $error;
							}
						break;
						
						case 'numeric':
						    if(!is_numeric($_POST[$key]) == $key) {
								$this->jun_error[$key] = $error;
							}
						break;
						
						case 'is_email':
						    if(!$this->validEmail($_POST[$key]) == $key) {
								$this->jun_error[$key] = $error;
							}
						break;
						
						case 'alphanumeric':
						    if(!ctype_alnum($_POST[$key]) == $key) {
								$this->jun_error[$key] = $error;
							}
						break;
						
						case 'between':
						    foreach($error as $between => $minmax) {
								//echo $between .  '<br/>';
								switch($between) {
									case 'min':
									    //echo $between . $minmax;
									    if(strlen($_POST[$key]) < $minmax) {
										    $this->jun_error[$key] = $error['error'];	
										}
									break;
									
									case 'max':
									    //echo $between . $minmax;
									    if(strlen($_POST[$key]) > $minmax) {
										    $this->jun_error[$key] = $error['error'];	
										}
									break;
									
								}
							}
						break;
						
						case 'is_uniq':
						    //echo $error['table']. '-' . $error['field'] . '-' . $_POST[$key];
						    if($this->doCount($error['field'], $_POST[$key]) > 0) {
							    $this->jun_error[$key] = $error['error'];	
							}
						break;
						
						case 'is_exist':
						    //echo $error['table']. '-' . $error['field'] . '-' . $_POST[$key];
						    if($this->doCount($error['field'], $_POST[$key]) < 1) {
							    $this->jun_error[$key] = $error['error'];	
							} else {
								
							}
						break;
						
						case 'equal_to':
	
						    if($_POST[$key] != $_POST[$value['equal_to']]) {
								$this->jun_error[$key] = $value['error'];
							}
						break;
						
					
						
						/**
	                    * return url
	                    */					
						case 'is_url':
						    if(!$this->is_url($_POST[$key]) == $key) {
								$this->jun_error[$key] = $error;
							}
						break;
						
						/**
	                    * check or radio button
	                    */					
						case 'is_check':
						    if(empty($_POST[$key]) == $key) {
								$this->jun_error[$key] = $error;
							}
						break;
						
						/**
	                    * select option form, make sure first value = empty or 0
	                    */
						case 'is_select':
						    if($_POST[$key] == '' || $_POST[$key] == 0) {
								$this->jun_error[$key] = $error;
							}
						break;
					}
				}
			
			}
		}
	}
	
	public function doCount($field, $value) {
		$user = Users::findFirst("$field = '$value'");
        if ($user != false) {
            return 1;
        } else {
			return 0;
		}
	}
	
	private function validEmail($email) {
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}
	
	
	/**
     * Finishes the active session redirecting to the index
     *
     * @return unknown
     */
    public function logoutAction()
    {
        $this->session->remove('jun_user_auth');
        $this->flash->success('Goodbye!');
        return $this->response->redirect('users/login');
    }
}