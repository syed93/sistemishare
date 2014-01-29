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
        $this->session->set('jun_user_auth', array(
            'id' => $user->id,
            'username' => $user->username
        ));
    }
    
    public function imall_image_dir() {
		return '/ishare/isharephal/uploads/imall/images/';
	}
	
	public function thumb_image_dir() {
		return '/ishare/isharephal/uploads/imall/thumbnails/';
	}
	
	public function imall_dir() {
		return '/ishare/imall';
	}
	
	public function host() {
		return 'http://ishare.com.my/';
	}
	
}