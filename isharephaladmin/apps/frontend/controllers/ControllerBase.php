<?php

namespace JunMy\Frontend\Controllers;

use Phalcon\Tag;

class ControllerBase extends \Phalcon\Mvc\Controller
{
    public function initialize()
    {
        //Prepend the application name to the title
        $this->tag->prependTitle('iShare.com.my | ');
    }
    
    /**
     * Register authenticated user into session data
     *
     * @param Users $user
     */
    public function _registerSession($user)
    {
        $this->session->set('junauth', array(
            'id' => $user->id,
            'name' => $user->username,
            'role' => $user->role
        ));
        
    }
    
    public function pageProtect() {
		if(!$this->session->get('junauth')) {
	        $this->flash->error('Please login to access members area');
			return $this->response->redirect('users/login');
		} else {
		    if(session_regenerate_id()) {
				return true;
			}
			
		}
	}
	
	public function user_image_dir() {
		return '/ishare/isharephal/uploads/profiles/';
	}
	
	/* 
	*  Protect page by admin role
	*  Return BOOLEAN
	*  1 Super Admin = 1 Whole systems
	*  2 Admin = 2 Whole system without: monitor, statistic, sales, profit, add admin
	*  3 Account = 3 iWallet, 
	*  4 Update Quotation = 4 Update, view user profile
	*  5 Renew = 5 Update, view user profile, renew insurance
	*  6 Activator = 6 View, update, add, activate user
	*  7 iMall = 7 add product, allowcate product, edit & delete
	*  8 
	*  9 
	*/ 
	public function admin_role($user_level, $roles) {
	    if(in_array($user_level, $roles)) {
			return true;
		} else {
			return $this->response->redirect('errors/notallowed');
		}
	}
	// 1 RENEW, 2 BUY IMALL, 3 TRANSFER TO OTHER USER, 4 DONATE, 5 WITHDRAW, 6 COMMISSION, 7 ADD FUND, 8 DEDUCT SMS 0.20, 9 SELL ON IMALL, 10 RECEIVE FROM OTHER USER, 11 BUY COMPANY ITEMS, 12 BUY E PINS,
	
	public function thumb_image_dir() {
		return '/ishare/isharephal/uploads/imall/thumbnails/';
	}
	
	public function imall_image_dir() {
		return '/ishare/isharephal/uploads/imall/images/';
	}
	
	public function imall_dir() {
		return '/ishare/imall';
	}
	
	public function host() {
		return 'http://ishare.com.my/';
	}
}