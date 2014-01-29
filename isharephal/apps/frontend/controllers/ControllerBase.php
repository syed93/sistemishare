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
            'username' => $user->username
        ));
    }
    
    public function pageProtect() {
		if(!$this->session->get('jun_user_auth')) {
	        $this->flash->error('Please login to access members area');
			return $this->response->redirect('users/login');
		}
		session_regenerate_id();
	}
	
	public function iprihatin_image_dir() {
		return '/ishare/isharephaladmin/uploads/iprihatins/';
	}
	
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
	
	
	
	// 1 RENEW, 2 BUY IMALL, 3 TRANSFER TO OTHER USER, 4 DONATE, 5 WITHDRAW, 6 COMMISSION, 7 ADD FUND, 8 DEDUCT SMS 0.20, 9 SELL ON IMALL, 10 RECEIVE FROM OTHER USER, 11 BUY COMPANY ITEMS, 12 BUY E PINS,
	
}