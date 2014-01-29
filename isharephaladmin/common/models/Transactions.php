<?php

namespace JunMy\Models;

class Transactions extends \Phalcon\Mvc\Model
{   
    public $id, $user_id, $title, $amount, $created, $reference, $type;
	
	public function getSource()
	{
		return 'transaction_histories';
	}

	

}
