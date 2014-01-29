<?php

namespace JunMy\Models;

class Epins extends \Phalcon\Mvc\Model
{
    public $id, $user_id, $epin, $created, $status, $used_username, $transaction;
	
	public function getSource()
	{
		return 'epins';
	}

}
